<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class ReferenceContactCollection.
 *
 * Represents the collection of reference contacts received from the CDT API.
 */
class ReferenceContactCollection extends ObjectCollection
{
    public const ITEM_TYPE = ReferenceContact::class;

    public function offsetGet(mixed $key): ?ReferenceContact
    {
        return parent::offsetGet($key);
    }
}
