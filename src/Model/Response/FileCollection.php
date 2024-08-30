<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class FileCollection.
 *
 * Represents the collection of files received from the CDT API.
 */
class FileCollection extends ObjectCollection
{
    public const ITEM_TYPE = File::class;

    public function offsetGet(mixed $key): ?File
    {
        return parent::offsetGet($key);
    }
}
