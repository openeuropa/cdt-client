<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class ReferenceFileCollection.
 *
 * Represents the collection of reference files sent to the CDT API.
 */
class ReferenceFileCollection extends ObjectCollection
{
    public const ITEM_TYPE = ReferenceFile::class;

    public function offsetGet(mixed $key): ?ReferenceFile
    {
        return parent::offsetGet($key);
    }
}
