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

/**
 * Trait ClientTestTrait
 *
 * Provides helper methods for testing classes that utilize the ApiClient.
 */
trait ClientTestTrait
{
    /**
     * @var array
     */
    protected $clientHistory = [];

    /**
     * @param array $configuration
     * @param array $responseQueue
     * @return ApiClientInterface
     */
    protected function getTestingClient(array $configuration = [], array $responseQueue = []): ApiClientInterface
    {
        $handlerStack = HandlerStack::create(new MockHandler($responseQueue));
        $handlerStack->push(Middleware::history($this->clientHistory));

        $httpFactory = new HttpFactory();
        return new ApiClient(
            new HttpClient(['handler' => $handlerStack]),
            $httpFactory,
            $httpFactory,
            $httpFactory,
            $configuration
        );
    }

    /**
     * @param ApiClientInterface $client
     * @return mixed
     */
    protected function getClientContainer(ApiClientInterface $client)
    {
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('container');
        $property->setAccessible(true);
        return $property->getValue($client);
    }
}
