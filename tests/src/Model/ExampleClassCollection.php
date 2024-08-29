<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class ExampleClassCollection.
 *
 * Represents the test collection of objects.
 */
class ExampleClassCollection extends ObjectCollection
{
    public const ITEM_TYPE = ExampleClass::class;

    public function offsetGet(mixed $key): ?ExampleClass
    {
        return parent::offsetGet($key);
    }
}
