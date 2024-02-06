<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\ApiClient
 */
class ClientTest extends TestCase
{
    use ClientTestTrait;

    public function testContainer(): void
    {
        $client = $this->getTestingClient([
            'mainApiEndpoint' => 'https://example.com/v2/CheckConnection',
            'tokenApiEndpoint' => 'https://example.com/token',
            'username' => 'testuser',
            'password' => 'pass',
            'client' => 'digit',
        ]);
        $container = $this->getClientContainer($client);

        // Check container services.
        $this->assertInstanceOf(MultipartStreamBuilder::class, $container->get('multipartStreamBuilder'));
        $this->assertInstanceOf(TokenEndpoint::class, $container->get('auth'));
        $this->assertInstanceOf(TokenAwareInterface::class, $container->get('main'));
    }
}
