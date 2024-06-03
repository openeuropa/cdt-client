<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient;

use OpenEuropa\CdtClient\ApiFactory;
use OpenEuropa\Tests\CdtClient\Traits\ApiTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass ApiFactory
 */
class ApiFactoryTest extends TestCase
{
    use ApiTestTrait;

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

        $factory = $this->getTestingApiFactory([
            'existing_key' => 'Existing Key',
            'other_key' => 'Other Key',
            'boolean_value_key' => false,
            0 => 'Zero',
            '99' => 'Bottles',
        ]);

        $reflection = new \ReflectionClass($factory);
        $method = $reflection->getMethod('extractConfigValues');
        $result = $method->invoke($factory, $keys_to_extract);

        $this->assertEquals([
            'existing_key' => 'Existing Key',
            0 => 'Zero',
            '99' => 'Bottles',
        ], $result);
    }
}
