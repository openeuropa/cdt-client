<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class JobSummaryCollection.
 *
 * Represents the collection of job summaries received from the CDT API.
 */
class JobSummaryCollection extends ObjectCollection
{
    public const ITEM_TYPE = JobSummary::class;

    public function offsetGet(mixed $key): ?JobSummary
    {
        return parent::offsetGet($key);
    }
}
