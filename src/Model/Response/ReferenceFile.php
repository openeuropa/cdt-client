<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Class ReferenceFile.
 *
 * Represents the reference file received from the CDT API.
 */
class ReferenceFile
{

    /**
     * The list of languages.
     *
     * @var string[]
     */
    protected array $languages;

    /**
     * The file name.
     */
    protected string $fileName;

    /**
     * Is private?
     */
    protected bool $isPrivate;

    /**
     * The links.
     *
     * @var Link[]
     */
    #[SerializedName('_links')]
    protected array $links;
}
