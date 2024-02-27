<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class TranslationJobCollection.
 *
 * Represents the collection of translation jobs sent to the CDT API.
 */
class TranslationJobCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?TranslationJob
    {
        return parent::offsetGet($key);
    }

    public function getItemType(): string
    {
        return TranslationJob::class;
    }
}
