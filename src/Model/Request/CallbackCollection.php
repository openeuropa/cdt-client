<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class CallbackCollection.
 *
 * Represents the collection of callbacks sent to the CDT API.
 */
class CallbackCollection extends ObjectCollection
{
    public const ITEM_TYPE = Callback::class;

    public function offsetGet(mixed $key): ?Callback
    {
        return parent::offsetGet($key);
    }
}
