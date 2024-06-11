<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient;

use OpenEuropa\CdtClient\ApiFactory;
use OpenEuropa\CdtClient\Endpoint\IdentifierEndpoint;
use OpenEuropa\CdtClient\Endpoint\MainEndpoint;
use OpenEuropa\CdtClient\Endpoint\ReferenceDataEndpoint;
use OpenEuropa\CdtClient\Endpoint\RequestsEndpoint;
use OpenEuropa\CdtClient\Endpoint\StatusEndpoint;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Endpoint\ValidateEndpoint;
use OpenEuropa\CdtClient\Http\Download;
use OpenEuropa\Tests\CdtClient\Traits\ApiTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\ApiFactory
 */
class ApiFactoryTest extends TestCase
{
    use ApiTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\ApiFactory
     */
    public function testExtractConfigValues(): void
    {
        $keys_to_extract = [
            'existing_key',
            'non_existing_key',
            0,
            '99',
        ];

        $apiFactory = new ApiFactory($this->getTestingRest(), [
            'existing_key' => 'Existing Key',
            'other_key' => 'Other Key',
            'boolean_value_key' => false,
            0 => 'Zero',
            '99' => 'Bottles',
        ]);

        $reflection = new \ReflectionClass($apiFactory);
        $method = $reflection->getMethod('extractConfigValues');
        $result = $method->invoke($apiFactory, $keys_to_extract);

        $this->assertEquals([
            'existing_key' => 'Existing Key',
            0 => 'Zero',
            '99' => 'Bottles',
        ], $result);
    }

    /**
     * @covers ::createTokenEndpoint
     */
    public function testSuccessTokenEndpointCreation(): void
    {
        $apiFactory = new ApiFactory($this->getTestingRest(), $this->getDefaultConfiguration());
        $this->assertInstanceOf(TokenEndpoint::class, $apiFactory->createTokenEndpoint());
    }

    /**
     * @covers ::createEndpoint
     */
    public function testFailedTokenEndpointCreation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Token endpoints should be created using 'createTokenEndpoint' method.");
        $apiFactory = new ApiFactory($this->getTestingRest(), $this->getDefaultConfiguration());
        $this->assertInstanceOf(TokenEndpoint::class, $apiFactory->createEndpoint(TokenEndpoint::class));
    }

    /**
     * @covers ::createEndpoint
     * @covers ::createDownload
     */
    public function testSuccessfulEndpointCreation(): void
    {
        $apiFactory = new ApiFactory($this->getTestingRest(), $this->getDefaultConfiguration());
        $apiFactory->setToken($this->getTestingToken());

        $this->assertInstanceOf(ReferenceDataEndpoint::class, $apiFactory->createEndpoint(ReferenceDataEndpoint::class));
        $this->assertInstanceOf(MainEndpoint::class, $apiFactory->createEndpoint(MainEndpoint::class));
        $this->assertInstanceOf(ValidateEndpoint::class, $apiFactory->createEndpoint(ValidateEndpoint::class));
        $this->assertInstanceOf(RequestsEndpoint::class, $apiFactory->createEndpoint(RequestsEndpoint::class));
        $this->assertInstanceOf(IdentifierEndpoint::class, $apiFactory->createEndpoint(IdentifierEndpoint::class));
        $this->assertInstanceOf(StatusEndpoint::class, $apiFactory->createEndpoint(StatusEndpoint::class));
        $this->assertInstanceOf(Download::class, $apiFactory->createDownload());
    }

    /**
     * @covers ::createEndpoint
     */
    public function testFailedEndpointCreation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid endpoint class: 'InvalidEndpoint'.");

        $apiFactory = new ApiFactory($this->getTestingRest(), $this->getDefaultConfiguration());
        $apiFactory->setToken($this->getTestingToken());
        $apiFactory->createEndpoint('InvalidEndpoint');
    }
}
