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
    protected string $comment;

    protected bool $isHTML;

    protected string $from;

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function isHTML(): bool
    {
        return $this->isHTML;
    }

    public function setIsHTML(bool $isHTML): self
    {
        $this->isHTML = $isHTML;
        return $this;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function setFrom(string $from): self
    {
        $this->from = $from;
        return $this;
    }
}
