<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class FileCollection.
 *
 * Represents the collection of files received from the CDT API.
 */
class FileCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?File
    {
        return parent::offsetGet($key);
    }

    public static function getItemType(): string
    {
        return File::class;
    }
}
