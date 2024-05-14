<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\HttpFactory;
use OpenEuropa\CdtClient\ApiClient;
use OpenEuropa\CdtClient\Contract\ApiClientInterface;
use Psr\Container\ContainerInterface;

/**
 * Trait ClientTestTrait
 *
 * Provides helper methods for testing classes that utilize the ApiClient.
 */
trait ClientTestTrait
{
    /**
     * @var array<int, array<string, mixed>>
     */
    protected array $clientHistory = [];

    /**
     * @param array<mixed> $configuration
     * @param array<int, mixed> $responseQueue
     */
    protected function getTestingClient(array $configuration = [], array $responseQueue = []): ApiClientInterface
    {
        $handlerStack = HandlerStack::create(new MockHandler($responseQueue));
        $handlerStack->push(Middleware::history($this->clientHistory));

        $defaultConfiguration = [
            'mainApiEndpoint' => 'https://example.com/v2/CheckConnection',
            'tokenApiEndpoint' => 'https://example.com/token',
            'validateApiEndpoint' => 'https://example.com/v2/requests/validate',
            'requestsApiEndpoint' => 'https://example.com/v2/requests',
            'identifierApiEndpoint' => 'https://example.com/v2/requests/requestIdentifierByCorrelationId/:correlationId',
            'statusApiEndpoint' => 'https://example.com/v2/requests/:requestyear/:requestnumber',
            'fileApiEndpoint' => 'https://example.com/v2/requests/:requestyear/:requestnumber/targets-base64',
            'referenceDataApiEndpoint' => 'https://example.com/v2/referenceData',
            'username' => 'testuser',
            'password' => 'pass',
            'client' => 'digit',
        ];

        $httpFactory = new HttpFactory();
        return new ApiClient(
            new HttpClient(['handler' => $handlerStack]),
            $httpFactory,
            $httpFactory,
            $configuration + $defaultConfiguration
        );
    }

    protected function getClientContainer(ApiClientInterface $client): ContainerInterface
    {
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('container');
        $container = $property->getValue($client);
        assert($container instanceof ContainerInterface);
        return $container;
    }
}
