<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient;

use OpenEuropa\CdtClient\Contract\ApiClientInterface;
use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Endpoint\FileEndpoint;
use OpenEuropa\CdtClient\Endpoint\IdentifierEndpoint;
use OpenEuropa\CdtClient\Endpoint\MainEndpoint;
use OpenEuropa\CdtClient\Endpoint\RequestsEndpoint;
use OpenEuropa\CdtClient\Endpoint\StatusEndpoint;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Endpoint\ValidateEndpoint;
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
        $this->client = $this->getTestingClient([
            'mainApiEndpoint' => 'https://example.com/v2/CheckConnection',
            'tokenApiEndpoint' => 'https://example.com/token',
            'validateApiEndpoint' => 'https://example.com/v2/requests/validate',
            'requestsApiEndpoint' => 'https://example.com/v2/requests',
            'identifierApiEndpoint' => 'https://example.com/v2/requests/requestIdentifierByCorrelationId/:correlationId',
            'statusApiEndpoint' => 'https://example.com/v2/requests/:requestyear/:requestnumber',
            'fileApiEndpoint' => 'https://example.com/v2/requests/:requestyear/:requestnumber/targets-base64',
            'username' => 'testuser',
            'password' => 'pass',
            'client' => 'digit',
        ]);
    }

    /**
     * @covers ::createContainer
     * @covers ::getConfigValue
     * @covers ::extractConfigValues
     */
    public function testContainer(): void
    {
        $container = $this->getClientContainer($this->client);

        // Check container services.
        $this->assertInstanceOf(TokenEndpoint::class, $container->get('auth'));

        $this->assertInstanceOf(MainEndpoint::class, $container->get('main'));
        $this->assertInstanceOf(TokenAwareInterface::class, $container->get('main'));

        $this->assertInstanceOf(ValidateEndpoint::class, $container->get('validate'));
        $this->assertInstanceOf(TokenAwareInterface::class, $container->get('validate'));

        $this->assertInstanceOf(RequestsEndpoint::class, $container->get('requests'));
        $this->assertInstanceOf(TokenAwareInterface::class, $container->get('requests'));

        $this->assertInstanceOf(IdentifierEndpoint::class, $container->get('identifier'));
        $this->assertInstanceOf(TokenAwareInterface::class, $container->get('identifier'));

        $this->assertInstanceOf(StatusEndpoint::class, $container->get('status'));
        $this->assertInstanceOf(TokenAwareInterface::class, $container->get('status'));

        $this->assertInstanceOf(FileEndpoint::class, $container->get('file'));
        $this->assertInstanceOf(TokenAwareInterface::class, $container->get('file'));
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
