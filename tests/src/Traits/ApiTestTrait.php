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
use OpenEuropa\CdtClient\Contract\ApiFactoryInterface;
use OpenEuropa\CdtClient\Http\Rest;
use OpenEuropa\CdtClient\Model\Response\Token;

/**
 * Trait ApiTestTrait
 *
 * Provides helper methods for testing classes that utilize ApiClient and ApiFactory.
 */
trait ApiTestTrait
{
    /**
     * @var array<int, array<string, mixed>>
     */
    protected array $clientHistory = [];

    /**
     * @param array<mixed> $configuration
     * @param array<int, mixed> $responseQueue
     */
    protected function getTestingApiClient(array $configuration = [], array $responseQueue = []): ApiClientInterface
    {
        return new ApiClient(
            new HttpClient(['handler' => $this->getHandlerStack($responseQueue)]),
            new HttpFactory(),
            new HttpFactory(),
            $configuration + $this->getDefaultConfiguration()
        );
    }

    /**
     * @param array<mixed> $configuration
     * @param array<int, mixed> $responseQueue
     */
    protected function getTestingApiFactory(array $configuration = [], array $responseQueue = [], bool $withToken = true): ApiFactoryInterface
    {
        $rest = new Rest(
            new HttpClient(['handler' => $this->getHandlerStack($responseQueue)]),
            new HttpFactory(),
            new HttpFactory(),
        );
        $apiFactory = new ApiFactory($rest, $configuration + $this->getDefaultConfiguration());
        if ($withToken) {
            $token = (new Token())->setAccessToken('JWT_TOKEN')
                ->setTokenType('bearer')
                ->setExpiresIn(3600);
            $apiFactory->setToken($token);
        }

        return $apiFactory;
    }

    /**
     * @return array<mixed>
     */
    protected function getDefaultConfiguration(): array
    {
        return [
            'apiBaseUrl' => 'https://example.com',
            'username' => 'testuser',
            'password' => 'pass',
            'client' => 'digit',
        ];
    }

    /**
     * @param array<int, mixed> $responseQueue
     */
    protected function getHandlerStack(array $responseQueue): HandlerStack
    {
        $handlerStack = HandlerStack::create(new MockHandler($responseQueue));
        $handlerStack->push(Middleware::history($this->clientHistory));
        return $handlerStack;
    }
}
