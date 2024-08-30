<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\StringCollection;

/**
 * Class ReferenceUrl.
 *
 * Represents the reference URL sent to the CDT API.
 */
class ReferenceUrl
{
    protected string $url;

    protected string $shortName;

    protected StringCollection $referenceLanguages;

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

    public function getReferenceLanguages(): StringCollection
    {
        return $this->referenceLanguages;
    }

    public function setReferenceLanguages(StringCollection $referenceLanguages): self
    {
        $this->referenceLanguages = $referenceLanguages;

        return $this;
    }
}
