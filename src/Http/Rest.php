<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Http;

use OpenEuropa\CdtClient\Contract\RestInterface;
use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * A simple REST client injected to endpoints.
 */
class Rest implements RestInterface
{
    public function __construct(
        protected ClientInterface $httpClient,
        protected RequestFactoryInterface $requestFactory,
        protected StreamFactoryInterface $streamFactory
    ) {
    }

    /**
     * @inheritDoc
     */
    public function get(string $uri, array $headers = []): ResponseInterface
    {
        return $this->doRequest('GET', $uri, $headers);
    }

    /**
     * @inheritDoc
     */
    public function postJson(string $uri, string $jsonBody, array $headers = []): ResponseInterface
    {
        $headers['Content-Type'] = 'application/json';
        return $this->doRequest('POST', $uri, $headers, $jsonBody);
    }

    /**
     * @inheritDoc
     */
    public function postForm(string $uri, array $formFields, array $headers = []): ResponseInterface
    {
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        return $this->doRequest('POST', $uri, $headers, http_build_query($formFields));
    }

    /**
     * @param array<string, mixed> $headers
     *
     * @throws ClientExceptionInterface If an error happens during the client request.
     * @throws InvalidStatusCodeException If the API endpoint returns a status code other than 200.
     */
    protected function doRequest(string $method, string $uri, array $headers = [], ?string $body = null): ResponseInterface
    {
        $request = $this->requestFactory->createRequest($method, $uri);
        if (!is_null($body)) {
            $stream = $this->streamFactory->createStream($body);
            $request = $request->withBody($stream);
        }
        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }
        $response = $this->httpClient->sendRequest($request);

        if (!in_array($response->getStatusCode(), [200, 201], true)) {
            throw new InvalidStatusCodeException(
                "The API endpoint returns {$response->getStatusCode()}",
                0,
                null,
                $response
            );
        }

        return $response;
    }
}
