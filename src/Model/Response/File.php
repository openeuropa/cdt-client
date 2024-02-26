<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Class File.
 *
 * Represents the single file received from the CDT API.
 * The Base64 content is optional and depends on the context.
 * The class is used in a few kinds of responses.
 */
class File
{
    /**
     * The file content encoded in base64 (optional).
     * @todo Implement base64 encoding in the serializer. It may require adding DataUriNormalizer and prepending the field content by "data:".
     */
    #[SerializedName('base64')]
    protected string $content;

    /**
     * The source language.
     */
    protected string $sourceLanguage;

    /**
     * The target language.
     */
    protected string $targetLanguage;

    /**
     * The source document.
     */
    protected string $sourceDocument;

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
