<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class LinkCollection.
 *
 * Represents the collection of links received from the CDT API.
 */
class LinkCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?Link
    {
        return parent::offsetGet($key);
    }

    public static function getItemType(): string
    {
        return Link::class;
    }
}
