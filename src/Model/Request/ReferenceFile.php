<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

/**
 * Class ReferenceFile.
 *
 * Represents the reference file sent to the CDT API.
 */
class ReferenceFile
{
    protected File $file;

    /**
     * @var string[]
     */
    protected array $referenceLanguages;

    public function getFile(): File
    {
        return $this->file;
    }

    public function setFile(File $file): ReferenceFile
    {
        $this->file = $file;
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
    public function setReferenceLanguages(array $referenceLanguages): ReferenceFile
    {
        $this->referenceLanguages = $referenceLanguages;
        return $this;
    }
}
