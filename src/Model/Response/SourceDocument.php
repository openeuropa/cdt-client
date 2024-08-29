<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use Symfony\Component\Serializer\Annotation\SerializedPath;

/**
 * Class SourceDocument.
 *
 * Represents the single source document received from the CDT API.
 */
class SourceDocument
{
    protected string $fileName;

    protected bool $isPrivate;

    #[SerializedPath('[_links]')]
    protected LinkCollection $links;

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function isPrivate(): bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    public function getLinks(): LinkCollection
    {
        return $this->links;
    }

    public function setLinks(LinkCollection $links): self
    {
        $this->links = $links;

        return $this;
    }
}
