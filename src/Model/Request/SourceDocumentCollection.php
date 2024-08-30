<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class SourceDocumentCollection.
 *
 * Represents the collection of source documents sent to the CDT API.
 */
class SourceDocumentCollection extends ObjectCollection
{
    public const ITEM_TYPE = SourceDocument::class;

    public function offsetGet(mixed $key): ?SourceDocument
    {
        return parent::offsetGet($key);
    }
}
