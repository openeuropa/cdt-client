<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\StringCollection;
use Symfony\Component\Serializer\Annotation\SerializedPath;

/**
 * Class ReferenceFile.
 *
 * Represents the reference file received from the CDT API.
 */
class ReferenceFile
{
    protected StringCollection $languages;

    protected string $fileName;

    protected bool $isPrivate;

    #[SerializedPath('[_links]')]
    protected LinkCollection $links;

    public function getLanguages(): StringCollection
    {
        return $this->languages;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\StringCollection|array<int, string> $languages
     */
    public function setLanguages(StringCollection|array $languages): self
    {
        $this->languages = is_array($languages) ? new StringCollection($languages) : $languages;

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
     * @param \OpenEuropa\CdtClient\Model\Response\LinkCollection|array<string, \OpenEuropa\CdtClient\Model\Response\Link> $links
     */
    public function setLinks(LinkCollection|array $links): self
    {
        $this->links = is_array($links) ? new LinkCollection($links) : $links;

        return $this;
    }
}
