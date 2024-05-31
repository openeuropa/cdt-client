<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient;

use OpenEuropa\CdtClient\ApiFactory;
use OpenEuropa\CdtClient\Contract\ApiClientInterface;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\ApiClient
 */
class ApiClientTest extends TestCase
{
    use ClientTestTrait;

    protected ApiClientInterface $client;

    protected function setUp(): void
    {
        $this->client = $this->getTestingApiClient();
    }

    /**
     * @covers ::setToken
     */
    public function testToken(): void
    {
        $token = new Token();
        $token->setAccessToken('testtoken');
        $this->client->setToken($token);

        // Use reflection to access the protected property.
        $apiClientReflection = new \ReflectionClass($this->client);
        $apiFactoryProperty = $apiClientReflection->getProperty('apiFactory');
        $apiFactory = $apiFactoryProperty->getValue($this->client);
        assert($apiFactory instanceof ApiFactory);

        $apiFactoryReflection = new \ReflectionClass($apiFactory);
        $tokenProperty = $apiFactoryReflection->getProperty('token');
        $actualToken = $tokenProperty->getValue($apiFactory);
        self::assertEquals($token, $actualToken);
    }
}
