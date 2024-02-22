<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Endpoint\EndpointBase;
use PHPUnit\Framework\MockObject\Generator\Generator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\EndpointBase
 */
class EndpointBaseTest extends TestCase
{
    /**
     * Tests that the endpoint URL is required.
     *
     * @covers ::__construct
     */
    public function testEndpointUrlValidation(): void
    {
        $this->expectExceptionObject(new InvalidOptionsException('The option "endpointUrl" with value "INVALID_URL" is invalid.'));
        (new Generator())->testDouble(EndpointBase::class, true, ['execute'], [
            'INVALID_URL',
        ]);
    }

    /**
     * Tests that the base endpoint class doesn't expect any configuration but the endpoint URL.
     *
     * @covers ::__construct
     */
    public function testDefinedConfig(): void
    {
        $this->expectExceptionObject(new UndefinedOptionsException('The option "foo" does not exist. Defined options are: "endpointUrl".'));
        (new Generator())->testDouble(EndpointBase::class, true, ['execute'], [
            'http://example.com/v2/checkConnection',
            [
                'foo' => 'bar',
            ]
        ]);
    }
}
