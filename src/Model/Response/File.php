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
    protected string $sourceLanguage;

    protected string $targetLanguage;

    protected string $sourceDocument;

    protected string $fileName;

    protected bool $isPrivate;

    /**
     * @var array<string, Link>
     */
    #[SerializedPath('[_links]')]
    protected array $links;

    public function getSourceLanguage(): string
    {
        return $this->sourceLanguage;
    }

    public function setSourceLanguage(string $sourceLanguage): self
    {
        $this->sourceLanguage = $sourceLanguage;
        return $this;
    }

    public function getTargetLanguage(): string
    {
        return $this->targetLanguage;
    }

    public function setTargetLanguage(string $targetLanguage): self
    {
        $this->targetLanguage = $targetLanguage;
        return $this;
    }

    public function getSourceDocument(): string
    {
        return $this->sourceDocument;
    }

    public function setSourceDocument(string $sourceDocument): self
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

    /**
     * @return array<string, Link>
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param array<string, Link> $links
     */
    public function setLinks(array $links): self
    {
        $this->links = $links;
        return $this;
    }
}
