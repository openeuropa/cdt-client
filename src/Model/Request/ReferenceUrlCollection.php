<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class ReferenceUrlCollection.
 *
 * Represents the collection of reference urls sent to the CDT API.
 */
class ReferenceUrlCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?ReferenceUrl
    {
        return parent::offsetGet($key);
    }

    public function getItemType(): string
    {
        return ReferenceUrl::class;
    }
}
