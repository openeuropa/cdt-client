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

    public function setLanguages(StringCollection $languages): self
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
