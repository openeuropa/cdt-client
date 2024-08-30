<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\ObjectCollection
 */
class ObjectCollectionTest extends TestCase
{
    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\ObjectCollection
     */
    public function testCollection(): void
    {
        $objects = [
            new ExampleClass('object1'),
            'second' => new ExampleClass('object2'),
        ];
        $object3 = new ExampleClass('object3');
        $object4 = new ExampleClass('object4');
        $collection = new ExampleClassCollection($objects);

        $this->assertSame($objects[0], $collection->offsetGet(0));
        $this->assertSame($objects['second'], $collection->offsetGet('second'));
        $collection->append($object3);
        $this->assertSame($object3, $collection->offsetGet(1));
        $collection->offsetSet('last', $object4);
        $this->assertSame($object4, $collection->offsetGet('last'));
    }

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\ObjectCollection
     */
    public function testConstructTypeValidation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid argument type on item #second: string, expected instance of OpenEuropa\Tests\CdtClient\Model\ExampleClass.');
        $objects = [
            new ExampleClass('object1'),
            'second' => 'string',
        ];
        new ExampleClassCollection($objects);
    }

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\ObjectCollection
     */
    public function testAppendTypeValidation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid argument type on appended item: string, expected instance of OpenEuropa\Tests\CdtClient\Model\ExampleClass.');
        $collection = new ExampleClassCollection([]);
        $collection[] = 'string';
    }
}
