<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class ReferenceContactCollection.
 *
 * Represents the collection of reference contacts received from the CDT API.
 */
class ReferenceContactCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?ReferenceContact
    {
        return parent::offsetGet($key);
    }

    public function getItemType(): string
    {
        return ReferenceContact::class;
    }
}
