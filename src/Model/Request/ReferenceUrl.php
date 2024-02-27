<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

/**
 * Class ReferenceUrl.
 *
 * Represents the reference URL sent to the CDT API.
 */
class ReferenceUrl
{
    /**
     * The URL.
     */
    protected string $url;

    /**
     * The short name.
     */
    protected string $shortName;

    /**
     * The reference languages.
     *
     * @var string[]
     */
    protected array $referenceLanguages;

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getReferenceLanguages(): array
    {
        return $this->referenceLanguages;
    }

    /**
     * @param string[] $referenceLanguages
     */
    public function setReferenceLanguages(array $referenceLanguages): self
    {
        $this->referenceLanguages = $referenceLanguages;
        return $this;
    }
}
