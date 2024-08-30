<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model;

/**
 * Class StringCollection.
 *
 * Represents the collection of strings.
 */
class StringCollection extends ObjectCollection
{
    public const ITEM_TYPE = 'string';

    public function offsetGet(mixed $key): ?string
    {
        return parent::offsetGet($key);
    }

    protected function checkArgumentType(mixed $value, mixed $affectedKey = null): void
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid argument type on %s: %s, expected string.',
                is_null($affectedKey) ? 'appended item' : "item #$affectedKey",
                get_debug_type($value),
            ));
        }
    }
}
