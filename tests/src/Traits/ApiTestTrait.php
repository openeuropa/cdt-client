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
use OpenEuropa\CdtClient\Contract\RestInterface;
use OpenEuropa\CdtClient\Http\Rest;
use OpenEuropa\CdtClient\Model\Response\Token;

/**
 * Trait ApiTestTrait
 *
 * Provides helper methods for testing classes that utilize ApiClient and Rest.
 */
trait ApiTestTrait
{
    /**
     * @var array<int, array<string, mixed>>
     */
    protected array $clientHistory = [];

    /**
     * @covers \OpenEuropa\CdtClient\ApiClient
     *
     * @param array<mixed> $configuration
     * @param array<int, mixed> $responseQueue
     */
    protected function getTestingApiClient(array $configuration = [], array $responseQueue = [], bool $withToken = true): ApiClientInterface
    {
        $apiClient = new ApiClient(
            new HttpClient(['handler' => $this->getHandlerStack($responseQueue)]),
            new HttpFactory(),
            new HttpFactory(),
            $configuration + $this->getDefaultConfiguration(),
        );
        if ($withToken) {
            $token = (new Token())->setAccessToken('JWT_TOKEN')
                ->setTokenType('bearer')
                ->setExpiresIn(3600);
            $apiClient->setToken($token);
        }

        return $apiClient;
    }

    /**
     * @param array<int, mixed> $responseQueue
     */
    protected function getTestingRest(array $responseQueue = []): RestInterface
    {
        return new Rest(
            new HttpClient(['handler' => $this->getHandlerStack($responseQueue)]),
            new HttpFactory(),
            new HttpFactory(),
        );
    }

    protected function getTestingToken(): Token
    {
        return (new Token())
            ->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
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
