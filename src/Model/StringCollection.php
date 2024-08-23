<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model;

/**
 * Class StringCollection.
 *
 * Represents the collection of strings.
 */
class StringCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?string
    {
        return parent::offsetGet($key);
    }

    public static function getItemType(): string
    {
        return 'string';
    }
}
