<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class JobSummaryCollection.
 *
 * Represents the collection of job summaries received from the CDT API.
 */
class JobSummaryCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?JobSummary
    {
        return parent::offsetGet($key);
    }

    public static function getItemType(): string
    {
        return JobSummary::class;
    }
}
