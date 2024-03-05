<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use Symfony\Component\Serializer\Annotation\SerializedPath;

/**
 * Class ReferenceFile.
 *
 * Represents the reference file received from the CDT API.
 */
class ReferenceFile
{
    /**
     * @var array<int, string>
     */
    protected array $languages;

    protected string $fileName;

    protected bool $isPrivate;

    /**
     * @var array<string, Link>
     */
    #[SerializedPath('[_links]')]
    protected array $links;

    /**
     * @return array<int, string>
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @param array<int, string> $languages
     */
    public function setLanguages(array $languages): self
    {
        $this->languages = $languages;
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
