<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Trait AssertTestCollectionTrait
 *
 * Provides methods for asserting objects that extend BaseCollection.
 *
 * This trait can be used in test classes to streamline assertions and improve code readability.
 */
trait AssertTestCollectionTrait
{
    /**
     * @psalm-template RealInstanceType of object
     * @psalm-param class-string<RealInstanceType> $class
     * @param array<int, mixed> $items
     */
    protected function assertCollection(BaseCollection $collection, string $class, array $items): void
    {
        foreach ($items as $key => $item) {
            assert($item instanceof $class);
            $this->assertSame($item, $collection[$key]);
        }

        $correctExtraItem = $this->getMockBuilder($class)->getMock();
        $collection['key'] = $correctExtraItem;
        $this->assertSame($correctExtraItem, $collection['key']);
        $this->assertTrue($collection->offsetExists('key'));
        unset($collection['key']);
        $this->assertFalse($collection->offsetExists('key'));
        $collection[] = $correctExtraItem;
        $collection->append($correctExtraItem);
        $this->assertSame(count($items) + 2, count($collection));

        $incorrectExtraItem = $this->getMockBuilder(\stdClass::class)->getMock();

        $expectedMessage = sprintf(
            'Invalid argument type: %s, expected instance of %s.',
            get_class($incorrectExtraItem),
            $class
        );

        try {
            $collection[] = $incorrectExtraItem;
        } catch (\InvalidArgumentException $e) {
            $this->assertSame($expectedMessage, $e->getMessage());
        }

        try {
            $collection->append($incorrectExtraItem);
        } catch (\InvalidArgumentException $e) {
            $this->assertSame($expectedMessage, $e->getMessage());
        }

        try {
            $collection['key2'] = $incorrectExtraItem;
        } catch (\InvalidArgumentException $e) {
            $this->assertSame($expectedMessage, $e->getMessage());
        }
    }
}
