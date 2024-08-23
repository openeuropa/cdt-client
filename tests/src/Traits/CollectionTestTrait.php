<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

/**
 * Trait CollectionTestTrait
 *
 * Provides helper methods for testing collections.
 */
trait CollectionTestTrait
{
    /**
     * @param array<mixed> $items
     */
    public function assertCollection(array $items, string $class): void
    {
        /** @var \OpenEuropa\CdtClient\Model\BaseCollection $collection */
        $collection = new $class($items);

        foreach ($items as $key => $item) {
            $this->assertTrue($collection->offsetExists($key));
            $this->assertSame($item, $collection->offsetGet($key));
        }

        // Test the type validation.
        $badTypeDetected = false;
        $badElement = new class {
        };
        try {
            $collection->append($badElement);
        } catch (\InvalidArgumentException $e) {
            $badTypeDetected = true;
        }
        $this->assertTrue($badTypeDetected);

        // Run the collection setters.
        if ($firstItem = $items[0]) {
            $collection->offsetSet('example', $firstItem);
            $this->assertTrue($collection->offsetExists('example'));
            $collection->append($firstItem);
            $this->assertCount(count($items) + 2, $collection);
        }
    }
}
