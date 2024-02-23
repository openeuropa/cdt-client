<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
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
     * @param array<string, mixed> $configuration
     * @param array<int, mixed> $responseQueue
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

    protected function getClientContainer(ApiClientInterface $client): ContainerInterface
    {
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('container');
        $property->setAccessible(true);
        $container = $property->getValue($client);
        assert($container instanceof ContainerInterface);
        return $container;
    }
}
