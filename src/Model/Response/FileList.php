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
     * The files
     *
     * @var File[]
     */
    protected array $files;
}
