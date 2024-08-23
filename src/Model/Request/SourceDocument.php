<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\StringCollection;

/**
 * Class SourceDocument.
 *
 * Represents the single source document sent to the CDT API.
 */
class SourceDocument
{
    protected File $file;

    protected StringCollection $sourceLanguages;

    protected string $outputDocumentFormatCode;

    protected TranslationJobCollection $translationJobs;

    protected bool $isPrivate;

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

    public function getSourceLanguages(): StringCollection
    {
        return $this->sourceLanguages;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\StringCollection|array<int, string> $sourceLanguages
     */
    public function setSourceLanguages(StringCollection|array $sourceLanguages): self
    {
        $this->sourceLanguages = is_array($sourceLanguages) ? new StringCollection($sourceLanguages) : $sourceLanguages;

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

    /**
     * @param \OpenEuropa\CdtClient\Model\Request\TranslationJobCollection|array<int, \OpenEuropa\CdtClient\Model\Request\TranslationJob> $translationJobs
     */
    public function setTranslationJobs(TranslationJobCollection|array $translationJobs): self
    {
        $this->translationJobs = is_array($translationJobs) ? new TranslationJobCollection($translationJobs) : $translationJobs;

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
