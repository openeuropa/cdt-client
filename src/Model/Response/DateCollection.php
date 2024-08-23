<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class DateCollection.
 *
 * Represents the collection of dates received from the CDT API.
 */
class DateCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?Date
    {
        return parent::offsetGet($key);
    }

    public static function getItemType(): string
    {
        return Date::class;
    }
}
