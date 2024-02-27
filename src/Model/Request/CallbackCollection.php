<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class CallbackCollection.
 *
 * Represents the collection of callbacks sent to the CDT API.
 */
class CallbackCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?Callback
    {
        return parent::offsetGet($key);
    }

    public function getItemType(): string
    {
        return Callback::class;
    }
}
