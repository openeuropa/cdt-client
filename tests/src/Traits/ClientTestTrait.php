<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\HttpFactory;
use OpenEuropa\CdtClient\ApiClient;
use OpenEuropa\CdtClient\ApiFactory;
use OpenEuropa\CdtClient\Contract\ApiClientInterface;

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
            'apiBaseUrl' => 'https://example.com',
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

    protected function getClientApiFactory(ApiClientInterface $client): ApiFactory
    {
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('apiFactory');
        $apiFactory = $property->getValue($client);
        assert($apiFactory instanceof ApiFactory);
        return $apiFactory;
    }
}
