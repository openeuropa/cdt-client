<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\ObjectCollection;

/**
 * Class CommentCollection.
 *
 * Represents the collection of comments received from the CDT API.
 */
class CommentCollection extends ObjectCollection
{
    public const ITEM_TYPE = Comment::class;

    public function offsetGet(mixed $key): ?Comment
    {
        return parent::offsetGet($key);
    }
}
