<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Model\Token;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\ApiClient
 */
class ApiClientTest extends TestCase
{
    use ClientTestTrait;

    /**
     * @covers ::__construct
     * @covers ::createContainer
     * @covers ::getConfigValue
     * @covers ::extractConfigValues
     */
    public function testContainer(): void
    {
        $client = $this->getTestingClient([
            'mainApiEndpoint' => 'https://example.com/v2/CheckConnection',
            'tokenApiEndpoint' => 'https://example.com/token',
            'validateApiEndpoint' => 'https://example.com/v2/requests/validate',
            'requestsApiEndpoint' => 'https://example.com/v2/requests',
            'username' => 'testuser',
            'password' => 'pass',
            'client' => 'digit',
        ]);
        $container = $this->getClientContainer($client);

        // Check container services.
        $this->assertInstanceOf(TokenEndpoint::class, $container->get('auth'));
        $this->assertInstanceOf(TokenAwareInterface::class, $container->get('main'));
    }

    /**
     * @covers ::setToken
     * @covers ::getToken
     */
    public function testToken(): void
    {
        // @todo Make the example configuration reusable, if it is irrelevant to the test.
        $client = $this->getTestingClient([
            'mainApiEndpoint' => 'https://example.com/v2/CheckConnection',
            'tokenApiEndpoint' => 'https://example.com/token',
            'validateApiEndpoint' => 'https://example.com/v2/requests/validate',
            'requestsApiEndpoint' => 'https://example.com/v2/requests',
            'username' => 'testuser',
            'password' => 'pass',
            'client' => 'digit',
        ]);

        $token = new Token();
        $token->setAccessToken('testtoken');
        $client->setToken($token);
        $this->assertEquals($token, $client->getToken());
    }

    /**
     * @covers ::extractConfigValues
     */
    public function testExtractConfigValues(): void
    {
        $keys_to_extract = [
            'existing_key',
            'non_existing_key',
            0,
            '99',
        ];

        $client = $this->getTestingClient([
            'existing_key' => 'Existing Key',
            'other_key' => 'Other Key',
            'boolean_value_key' => false,
            0 => 'Zero',
            '99' => 'Bottles',
        ]);

        $reflection = new \ReflectionClass($client);
        $method = $reflection->getMethod('extractConfigValues');
        $result = $method->invoke($client, $keys_to_extract);

        $this->assertEquals([
            'existing_key' => 'Existing Key',
            0 => 'Zero',
            '99' => 'Bottles',
        ], $result);
    }
}
