<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class SourceDocumentCollection.
 *
 * Represents the collection of source documents sent to the CDT API.
 */
class SourceDocumentCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?SourceDocument
    {
        return parent::offsetGet($key);
    }

    public function getItemType(): string
    {
        return SourceDocument::class;
    }
}
