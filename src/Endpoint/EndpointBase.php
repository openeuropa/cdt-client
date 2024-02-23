<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use OpenEuropa\CdtClient\Contract\EndpointInterface;
use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class EndpointBase
 *
 * Serves as the base for all endpoint classes. It provides a set of common functionalities such as handing HTTP
 * requests and other utilities. It also includes methods for handling endpoint configurations.
 *
 * The class is designed to be extended by specific endpoint classes, which can leverage these common functionalities
 * for their specific needs.
 *
 */
abstract class EndpointBase implements EndpointInterface
{
    /**
     * @var array<string, mixed>
     */
    protected array $configuration;

    protected ClientInterface $httpClient;

    protected RequestFactoryInterface $requestFactory;

    protected StreamFactoryInterface $streamFactory;

    protected UriFactoryInterface $uriFactory;

    protected MultipartStreamBuilder $multipartStreamBuilder;

    protected EncoderInterface $jsonEncoder;

    /**
     * @var string[]
     */
    protected array $headers = [];

    /**
     * @param string $endpointUrl
     *   The endpoint URL.
     * @param array<string, mixed> $configuration
     *   The endpoint configuration.
     */
    public function __construct(string $endpointUrl, array $configuration = [])
    {
        $configuration['endpointUrl'] = $endpointUrl;
        $this->configuration = $this->getConfigurationResolver()->resolve($configuration);
    }

    /**
     * @inheritDoc
     */
    public function setHttpClient(ClientInterface $httpClient): EndpointInterface
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): EndpointInterface
    {
        $this->requestFactory = $requestFactory;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory): EndpointInterface
    {
        $this->streamFactory = $streamFactory;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setUriFactory(UriFactoryInterface $uriFactory): EndpointInterface
    {
        $this->uriFactory = $uriFactory;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMultipartStreamBuilder(MultipartStreamBuilder $multipartStreamBuilder): EndpointInterface
    {
        $this->multipartStreamBuilder = $multipartStreamBuilder;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setJsonEncoder(EncoderInterface $jsonEncoder): EndpointInterface
    {
        $this->jsonEncoder = $jsonEncoder;
        return $this;
    }

    /**
     * Returns an option resolver configured to validate the configuration.
     *
     * @return OptionsResolver
     */
    protected function getConfigurationResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired('endpointUrl')
            ->setAllowedTypes('endpointUrl', 'string')
            ->setAllowedValues('endpointUrl', function (string $value) {
                return filter_var($value, FILTER_VALIDATE_URL);
            });

        return $resolver;
    }

    /**
     * @param string $configKey
     * @return mixed
     */
    protected function getConfigValue(string $configKey): mixed
    {
        if (!array_key_exists($configKey, $this->configuration)) {
            throw new \InvalidArgumentException("Invalid config key: '{$configKey}'. Valid keys: '" . implode("', '", array_keys($this->configuration)) . "'.");
        }
        return $this->configuration[$configKey];
    }

    /**
     * Sends a request and return its response.
     *
     * @param string $method
     *   The request method.
     *
     * @return ResponseInterface
     *   The response.
     *
     * @throws ClientExceptionInterface
     *   Thrown if a network error happened while processing the request.
     * @throws InvalidStatusCodeException
     *   Thrown when the API endpoint returns code other than 200.
     */
    protected function send(string $method): ResponseInterface
    {
        $method = strtoupper($method);
        $uri = $this->getRequestUri();
        $request = $this->requestFactory->createRequest($method, $uri);

        $methodsWithBody = ['POST', 'PUT', 'PATCH'];
        if (in_array($method, $methodsWithBody) && $body = $this->getRequestBody()) {
            $request = $request->withBody($body);
        }

        if ($headers = $this->getRequestHeaders()) {
            foreach ($headers as $name => $value) {
                $request = $request->withHeader($name, $value);
            }
        }

        assert($request instanceof RequestInterface);
        $response = $this->httpClient->sendRequest($request);

        if (!in_array($response->getStatusCode(), [200, 201], true)) {
            throw new InvalidStatusCodeException("{$method} {$uri} returns {$response->getStatusCode()}");
        }

        return $response;
    }

    /**
     * @return string
     */
    protected function getRequestUri(): string
    {
        $uri = $this->uriFactory->createUri($this->getConfigValue('endpointUrl'));
        $query = $this->getRequestUriQuery($uri);
        return $uri->withQuery(http_build_query($query))->__toString();
    }

    /**
     * @param UriInterface $uri
     *
     * @return array<string|array<mixed>>
     */
    protected function getRequestUriQuery(UriInterface $uri): array
    {
        $query = [];
        if ($queryString = $uri->getQuery()) {
            parse_str($queryString, $apiEndpointQuery);
            $query += $apiEndpointQuery;
        }
        return $query;
    }

    /**
     * @return string[]
     */
    protected function getRequestHeaders(): array
    {
        // Methods building the request URI or body may store additional headers
        // in $this->headers array, as they act before this method.
        return $this->headers;
    }

    /**
     * @return StreamInterface|null
     */
    protected function getRequestBody(): ?StreamInterface
    {
        // Multipart stream has precedence, if it has been defined.
        if ($parts = $this->getRequestMultipartStreamElements()) {
            foreach ($parts as $name => $part) {
                $contentType = $part['contentType'] ?? 'application/json';
                $this->multipartStreamBuilder->addResource($name, $part['content'], [
                    'headers' => [
                        'Content-Type' => $contentType,
                    ],
                    'filename' => $name,
                ]);
            }

            // The multipart stream needs to inform the server about the
            // Content-Type and  multipart parts boundary ID.
            $this->headers['Content-Type'] = 'multipart/form-data; boundary="' . $this->multipartStreamBuilder->getBoundary() . '"';

            return $this->multipartStreamBuilder->build();
        }

        // Simple form elements.
        if ($parts = $this->getRequestFormElements()) {
            // Give server guidance on how to decode the stream.
            $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
            return $this->streamFactory->createStream(http_build_query($parts));
        }

        // This endpoint didn't define a request body.
        return null;
    }

    /**
     * @return array<array<string>>
     *   Associative array of multipart parts keyed by the part name. The values
     *   are associative arrays with two keys:
     *   - content (string): The multipart part contents.
     *   - contentType (string, optional): The multipart part content type. If
     *     omitted, 'application/json' is assumed.
     */
    protected function getRequestMultipartStreamElements(): array
    {
        return [];
    }

    /**
     * @return string[]
     */
    protected function getRequestFormElements(): array
    {
        return [];
    }

    /**
     * Returns a serializer configured to decode the endpoint response.
     *
     * @return SerializerInterface
     */
    protected function getSerializer(): SerializerInterface
    {
        return new Serializer([
            new GetSetMethodNormalizer(
                null,
                new CamelCaseToSnakeCaseNameConverter(),
                new PhpDocExtractor()
            ),
            new ArrayDenormalizer(),
        ], [
            new JsonEncoder(),
        ]);
    }
}
