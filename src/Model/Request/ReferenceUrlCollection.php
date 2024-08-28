<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class ReferenceUrlCollection.
 *
 * Represents the collection of reference urls sent to the CDT API.
 */
class ReferenceUrlCollection extends ObjectCollection
{
    public const ITEM_TYPE = ReferenceUrl::class;

    public function offsetGet(mixed $key): ?ReferenceUrl
    {
        return parent::offsetGet($key);
    }
}
