<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient;

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
        $this->client = $this->getTestingClient();
    }

    /**
     * @covers ::setToken
     * @covers ::getToken
     */
    public function testToken(): void
    {
        $token = new Token();
        $token->setAccessToken('testtoken');
        $this->client->setToken($token);
        $this->assertEquals($token, $this->client->getToken());
    }
}
