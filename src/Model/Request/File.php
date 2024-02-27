<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

/**
 * Class File.
 *
 * Represents the single file sent to the CDT API.
 */
class File
{
    /**
     * The file name.
     */
    protected string $fileName;

    /**
     * The file content encoded in base64.
     * @todo: Encode while setting?
     */
    protected string $base64Data;

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getBase64Data(): string
    {
        return $this->base64Data;
    }

    public function setBase64Data(string $base64Data): self
    {
        $this->base64Data = $base64Data;
        return $this;
    }
}
