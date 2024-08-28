<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class TranslationJobCollection.
 *
 * Represents the collection of translation jobs sent to the CDT API.
 */
class TranslationJobCollection extends ObjectCollection
{
    public const ITEM_TYPE = TranslationJob::class;

    public function offsetGet(mixed $key): ?TranslationJob
    {
        return parent::offsetGet($key);
    }
}
