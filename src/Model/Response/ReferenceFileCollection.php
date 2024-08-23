<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class ReferenceFileCollection.
 *
 * Represents the collection of reference files received from the CDT API.
 */
class ReferenceFileCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?ReferenceFile
    {
        return parent::offsetGet($key);
    }

    public static function getItemType(): string
    {
        return ReferenceFile::class;
    }
}
