<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

/**
 * Class FileList.
 *
 * Represents the final list of translated files received from the CDT API.
 */
class FileList
{
    /**
     * @var array<int, File>
     */
    protected array $files;

    /**
     * @return array<int, File>
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @param array<int, File> $files
     */
    public function setFiles(array $files): self
    {
        $this->files = $files;
        return $this;
    }
}
