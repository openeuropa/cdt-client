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
}
