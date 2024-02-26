<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Class SourceDocument.
 *
 * Represents the single source document received from the CDT API.
 * It is a part of the translation response.
 */
class SourceDocument
{
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
