<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class ReferenceItemCollection.
 *
 * Represents the collection of reference items received from the CDT API.
 */
class ReferenceItemCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?ReferenceItem
    {
        return parent::offsetGet($key);
    }

    public function getItemType(): string
    {
        return ReferenceItem::class;
    }
}
