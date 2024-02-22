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

    /**
     * The file.
     */
    protected File $file;

    /**
     * The reference languages.
     *
     * @var string[]
     */
    protected array $referenceLanguages;
}
