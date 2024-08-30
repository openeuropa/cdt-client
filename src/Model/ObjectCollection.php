<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model;

/**
 * Class ObjectCollection.
 *
 * Represents the collection of objects.
 */
abstract class ObjectCollection extends BaseCollection
{
    protected function checkArgumentType(mixed $value, mixed $affectedKey = null): void
    {
        if (!($value instanceof (static::ITEM_TYPE))) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid argument type on %s: %s, expected instance of %s.',
                is_null($affectedKey) ? 'appended item' : "item #$affectedKey",
                get_debug_type($value),
                static::ITEM_TYPE,
            ));
        }
    }
}
