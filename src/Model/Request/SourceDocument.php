<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

/**
 * Class SourceDocument.
 *
 * Represents the single source document sent to the CDT API.
 */
class SourceDocument
{

    /**
     * The file.
     */
    protected File $file;

    /**
     * The source languages.
     *
     * @var string[]
     */
    protected array $sourceLanguages;

    /**
     * The output document format code.
     * Ex. TXT, HTML, XML, etc.
     */
    protected string $outputDocumentFormatCode;

    /**
     * The translation jobs.
     *
     * @var TranslationJob[]
     */
    protected array $translationJobs;

    /**
     * The confidentiality code from the ReferenceData.
     */
    protected string $confidentialityCode;

    /**
     * Is private?
     */
    protected bool $isPrivate;
}
