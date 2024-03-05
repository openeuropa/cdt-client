<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

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
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
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

    protected EncoderInterface $jsonEncoder;

    /**
     * @var string[]
     */
    protected array $headers = [];

    /**
     * @param array<string, mixed> $configuration
     */
    public function __construct(string $endpointUrl, array $configuration = [])
    {
        $configuration['endpointUrl'] = $endpointUrl;
        $this->configuration = $this->getConfigurationResolver()->resolve($configuration);
    }

    public function setHttpClient(ClientInterface $httpClient): EndpointInterface
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    public function setRequestFactory(RequestFactoryInterface $requestFactory): EndpointInterface
    {
        $this->requestFactory = $requestFactory;
        return $this;
    }

    public function setStreamFactory(StreamFactoryInterface $streamFactory): EndpointInterface
    {
        $this->streamFactory = $streamFactory;
        return $this;
    }

    public function setUriFactory(UriFactoryInterface $uriFactory): EndpointInterface
    {
        $this->uriFactory = $uriFactory;
        return $this;
    }

    public function setJsonEncoder(EncoderInterface $jsonEncoder): EndpointInterface
    {
        $this->jsonEncoder = $jsonEncoder;
        return $this;
    }

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

    protected function getConfigValue(string $configKey): mixed
    {
        if (!array_key_exists($configKey, $this->configuration)) {
            throw new \InvalidArgumentException("Invalid config key: '{$configKey}'. Valid keys: '" . implode("', '", array_keys($this->configuration)) . "'.");
        }
        return $this->configuration[$configKey];
    }

    /**
     * @param array<string, string> $replacements
     *   An associative array of replacements to be made in the request URI.
     *
     * @throws ClientExceptionInterface
     *   Thrown if a network error happened while processing the request.
     * @throws InvalidStatusCodeException
     *   Thrown when the API endpoint returns code other than 200 or 201.
     */
    protected function send(string $method, array $replacements = []): ResponseInterface
    {
        $method = strtoupper($method);
        $uri = $this->getRequestUri($replacements);
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
            $this->handleResponseException($response);
        }

        return $response;
    }

    /**
     * @throws InvalidStatusCodeException
     *   Thrown when the API endpoint returns code other than 200 or 201.
     */
    protected function handleResponseException(ResponseInterface $response): void
    {
        throw new InvalidStatusCodeException(
            "The API endpoint returns {$response->getStatusCode()}"
        );
    }

    /**
     * @param array<string, string> $replacements
     */
    protected function getRequestUri(array $replacements = []): string
    {
        $endpointUrl = $this->getConfigValue('endpointUrl');
        if ($replacements) {
            $endpointUrl = str_replace(array_keys($replacements), array_values($replacements), $endpointUrl);
        }
        $uri = $this->uriFactory->createUri($endpointUrl);
        $query = $this->getRequestUriQuery($uri);
        return $uri->withQuery(http_build_query($query))->__toString();
    }

    /**
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

    protected function getRequestBody(): ?StreamInterface
    {
        // Simple form elements.
        if ($parts = $this->getRequestFormElements()) {
            // Give server guidance on how to decode the stream.
            $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
            return $this->streamFactory->createStream(http_build_query($parts));
        }

        // Simple JSON body.
        if ($json = $this->getRequestJsonBody()) {
            $this->headers['Content-Type'] = 'application/json';
            return $this->streamFactory->createStream($json);
        }

        // This endpoint didn't define a request body.
        return null;
    }

    /**
     * @return string[]
     */
    protected function getRequestFormElements(): array
    {
        return [];
    }

    protected function getRequestJsonBody(): string
    {
        return '';
    }

    /**
     * Returns a serializer configured to decode the endpoint response.
     */
    protected function getSerializer(): SerializerInterface
    {
        return new Serializer([
            new JsonSerializableNormalizer(),
            new GetSetMethodNormalizer(
                new ClassMetadataFactory(
                    new AttributeLoader()
                ),
                null,
                new PhpDocExtractor()
            ),
            new DateTimeNormalizer(),
            new ArrayDenormalizer(),
        ], [
            new JsonEncoder(),
        ]);
    }
}
