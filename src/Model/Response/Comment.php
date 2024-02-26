<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

/**
 * Class Comment.
 *
 * Represents the single comment received from the CDT API.
 */
class Comment
{
    /**
     * The comment.
     */
    protected string $comment;

    /**
     * Is HTML?
     */
    protected bool $isHTML;

    /**
     * The source of the comment.
     * ex. Client
     */
    protected string $from;
}
