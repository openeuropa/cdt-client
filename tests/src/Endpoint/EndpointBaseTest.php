<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\RestInterface;
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
    protected RestInterface $restMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->restMock = $this->createMock(RestInterface::class);
    }

    /**
     * Tests that the base URL is required.
     *
     * @covers ::getConfigurationResolver
     */
    public function testEndpointUrlValidation(): void
    {
        $this->expectExceptionObject(new InvalidOptionsException('The option "apiBaseUrl" with value "INVALID_URL" is invalid.'));
        (new Generator())->testDouble(EndpointBase::class, true, [], [
            $this->restMock,
            ['apiBaseUrl' => 'INVALID_URL'],
        ]);
    }

    /**
     * Tests that the base endpoint class doesn't expect any configuration but the endpoint URL.
     *
     * @covers ::getConfigurationResolver
     */
    public function testDefinedConfig(): void
    {
        $this->expectExceptionObject(new UndefinedOptionsException('The option "foo" does not exist. Defined options are: "apiBaseUrl".'));
        (new Generator())->testDouble(EndpointBase::class, true, [], [
            $this->restMock,
            [
                'apiBaseUrl' => 'http://example.com',
                'foo' => 'bar',
            ]
        ]);
    }

    /**
     * Tests that the base endpoint class detects non-existing config key.
     *
     * @covers ::getConfigurationResolver
     * @covers ::getConfigValue
     */
    public function testInvalidConfigKey(): void
    {
        $double = (new Generator())->testDouble(EndpointBase::class, true, [], [
            $this->restMock,
            [
                'apiBaseUrl' => 'http://example.com',
            ],
        ]);

        $class = new \ReflectionClass(EndpointBase::class);
        $getConfigValueMethod = $class->getMethod('getConfigValue');

        $this->expectExceptionObject(new \InvalidArgumentException("Invalid config key: 'baz'. Valid keys: 'apiBaseUrl'."));
        $getConfigValueMethod->invokeArgs($double, ['baz']);
    }

    /**
     * Tests that the base endpoint handles url correctly.
     *
     * @param array<string, string> $replacements
     *
     * @dataProvider providerTestGetEndpointUrl
     *
     * @covers ::getEndpointUrl
     */
    public function testGetEndpointUrl(string $originalUrl, array $replacements, string $expectedUri): void
    {
        $double = (new Generator())->testDouble(EndpointBase::class, true, [], [
            $this->restMock,
            [
                'apiBaseUrl' => $originalUrl,
            ]
        ]);
        assert($double instanceof EndpointBase);

        $class = new \ReflectionClass(EndpointBase::class);
        $getEndpointUrlMethod = $class->getMethod('getEndpointUrl');
        $finalUri = $getEndpointUrlMethod->invokeArgs($double, ['replacements' => $replacements]);
        $this->assertEquals($expectedUri, $finalUri);
    }

    /**
     * @return array<int, mixed>
     */
    public static function providerTestGetEndpointUrl(): array
    {
        return [
            [
                'https://example.com/v2/test',
                [],
                'https://example.com/v2/test',
            ],
            [
                'https://example.com/v2/test',
                [':id' => '123'],
                'https://example.com/v2/test',
            ],
            [
                'https://example.com/v2/test/:id',
                [':id' => '123'],
                'https://example.com/v2/test/123',
            ],
            [
                'https://example.com/v2/test/:id?foo=bar&baz=:baz',
                [':id' => '123', ':baz' => '456'],
                'https://example.com/v2/test/123?foo=bar&baz=456',
            ],
        ];
    }
}
