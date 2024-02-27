<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Trait AssertCollectionTrait
 *
 * Provides methods for asserting objects that extend BaseCollection.
 *
 * This trait can be used in test classes to streamline assertions and improve code readability.
 */

trait AssertCollectionTrait
{
    /**
     * @param array<int, mixed> $items
     */
    protected function assertCollection(BaseCollection $collection, string $class, array $items, mixed $extraItem): void
    {
        foreach ($items as $key => $item) {
            assert($item instanceof $class);
            $this->assertSame($item, $collection[$key]);
        }
        $collection['key'] = $extraItem;
        $this->assertSame($extraItem, $collection['key']);
        $this->assertTrue($collection->offsetExists('key'));
        unset($collection['key']);
        $this->assertFalse($collection->offsetExists('key'));
        $collection[] = $extraItem;
        $this->assertSame(count($items) + 1, count($collection));
    }
}
