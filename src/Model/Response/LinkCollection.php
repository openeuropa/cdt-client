<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class LinkCollection.
 *
 * Represents the collection of links received from the CDT API.
 */
class LinkCollection extends ObjectCollection
{
    public const ITEM_TYPE = Link::class;

    public function offsetGet(mixed $key): ?Link
    {
        return parent::offsetGet($key);
    }
}
