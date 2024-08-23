<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\BaseCollection;

/**
 * Class CommentCollection.
 *
 * Represents the collection of comments received from the CDT API.
 */
class CommentCollection extends BaseCollection
{
    public function offsetGet(mixed $key): ?Comment
    {
        return parent::offsetGet($key);
    }

    public static function getItemType(): string
    {
        return Comment::class;
    }
}
