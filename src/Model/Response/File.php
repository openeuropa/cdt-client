<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use Symfony\Component\Serializer\Annotation\SerializedPath;

/**
 * Class File.
 *
 * Represents the single file received from the CDT API.
 */
class File
{
    protected ?string $sourceLanguage = null;

    protected ?string $targetLanguage = null;

    protected ?string $sourceDocument = null;

    protected string $fileName;

    protected bool $isPrivate;

    #[SerializedPath('[_links]')]
    protected LinkCollection $links;

    public function getSourceLanguage(): ?string
    {
        return $this->sourceLanguage;
    }

    public function setSourceLanguage(?string $sourceLanguage): self
    {
        $this->sourceLanguage = $sourceLanguage;

        return $this;
    }

    public function getTargetLanguage(): ?string
    {
        return $this->targetLanguage;
    }

    public function setTargetLanguage(?string $targetLanguage): self
    {
        $this->targetLanguage = $targetLanguage;

        return $this;
    }

    public function getSourceDocument(): ?string
    {
        return $this->sourceDocument;
    }

    public function setSourceDocument(?string $sourceDocument): self
    {
        $this->sourceDocument = $sourceDocument;

        return $this;
    }

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

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\LinkCollection|array<int, \OpenEuropa\CdtClient\Model\Response\Link> $links
     */
    public function setLinks(LinkCollection|array $links): self
    {
        $this->links = is_array($links) ? new LinkCollection($links) : $links;

        return $this;
    }
}
