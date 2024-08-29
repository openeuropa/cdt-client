<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model;

use OpenEuropa\CdtClient\Model\StringCollection;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\StringCollection
 */
class StringCollectionTest extends TestCase
{
    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\StringCollection
     */
    public function testCollection(): void
    {
        $strings = [
            'string1',
            'second' => 'string2',
        ];
        $string3 = 'string3';
        $string4 = 'string4';
        $collection = new StringCollection($strings);

        $this->assertSame($strings[0], $collection->offsetGet(0));
        $this->assertSame($strings['second'], $collection->offsetGet('second'));
        $collection->append($string3);
        $this->assertSame($string3, $collection->offsetGet(1));
        $collection->offsetSet('last', $string4);
        $this->assertSame($string4, $collection->offsetGet('last'));
    }

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\StringCollection
     */
    public function testConstructTypeValidation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid argument type on item #0: OpenEuropa\Tests\CdtClient\Model\ExampleClass, expected string.');
        $strings = [
            new ExampleClass('object1'),
            'second' => 'string',
        ];
        new StringCollection($strings);
    }

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\StringCollection
     */
    public function testAppendTypeValidation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid argument type on appended item: OpenEuropa\Tests\CdtClient\Model\ExampleClass, expected string.');
        $collection = new StringCollection([]);
        $collection[] = new ExampleClass('object1');
    }
}
