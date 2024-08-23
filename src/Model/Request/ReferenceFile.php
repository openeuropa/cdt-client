<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\StringCollection;

/**
 * Class ReferenceFile.
 *
 * Represents the reference file sent to the CDT API.
 */
class ReferenceFile
{
    protected File $file;

    protected StringCollection $referenceLanguages;

    public function getFile(): File
    {
        return $this->file;
    }

    public function setFile(File $file): ReferenceFile
    {
        $this->file = $file;

        return $this;
    }

    public function getReferenceLanguages(): StringCollection
    {
        return $this->referenceLanguages;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\StringCollection|array<int, string> $referenceLanguages
     */
    public function setReferenceLanguages(StringCollection|array $referenceLanguages): self
    {
        $this->referenceLanguages = is_array($referenceLanguages) ? new StringCollection($referenceLanguages) : $referenceLanguages;

        return $this;
    }
}
