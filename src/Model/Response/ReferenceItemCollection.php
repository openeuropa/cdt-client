<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class ReferenceItemCollection.
 *
 * Represents the collection of reference items received from the CDT API.
 */
class ReferenceItemCollection extends ObjectCollection
{
    public const ITEM_TYPE = ReferenceItem::class;

    public function offsetGet(mixed $key): ?ReferenceItem
    {
        return parent::offsetGet($key);
    }
}
