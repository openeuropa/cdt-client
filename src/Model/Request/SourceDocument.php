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
     */
    protected TranslationJobCollection $translationJobs;

    /**
     * Is private?
     */
    protected bool $isPrivate;

    /**
     * The confidentiality code from the ReferenceData.
     */
    protected string $confidentialityCode;

    public function getFile(): File
    {
        return $this->file;
    }

    public function setFile(File $file): self
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getSourceLanguages(): array
    {
        return $this->sourceLanguages;
    }

    /**
     * @param string[] $sourceLanguages
     */
    public function setSourceLanguages(array $sourceLanguages): self
    {
        $this->sourceLanguages = $sourceLanguages;
        return $this;
    }

    public function getOutputDocumentFormatCode(): string
    {
        return $this->outputDocumentFormatCode;
    }

    public function setOutputDocumentFormatCode(string $outputDocumentFormatCode): self
    {
        $this->outputDocumentFormatCode = $outputDocumentFormatCode;
        return $this;
    }

    public function getTranslationJobs(): TranslationJobCollection
    {
        return $this->translationJobs;
    }

    public function setTranslationJobs(TranslationJobCollection $translationJobs): self
    {
        $this->translationJobs = $translationJobs;
        return $this;
    }

    public function getConfidentialityCode(): string
    {
        return $this->confidentialityCode;
    }

    public function setConfidentialityCode(string $confidentialityCode): self
    {
        $this->confidentialityCode = $confidentialityCode;
        return $this;
    }

    public function isPrivate(): bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;
        return $this;
    }
}