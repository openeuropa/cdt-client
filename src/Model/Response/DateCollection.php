<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class DateCollection.
 *
 * Represents the collection of dates received from the CDT API.
 */
class DateCollection extends ObjectCollection
{
    public const ITEM_TYPE = Date::class;

    public function offsetGet(mixed $key): ?Date
    {
        return parent::offsetGet($key);
    }
}
