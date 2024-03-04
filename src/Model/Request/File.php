<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

/**
 * Class File.
 *
 * Represents the single file sent to the CDT API.
 */
class File implements \JsonSerializable
{
    protected string $fileName;

    protected string $content;

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            'fileName' => $this->fileName,
            'base64Data' => base64_encode($this->content),
        ];
    }
}
