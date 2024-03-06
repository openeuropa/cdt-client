<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

/**
 * Class TranslationJob.
 *
 * Represents the translation job sent to the CDT API.
 */
class TranslationJob
{
    protected float $volume;

    protected string $sourceLanguage;

    protected string $targetLanguage;

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function setVolume(float $volume): self
    {
        $this->volume = $volume;
        return $this;
    }

    public function getSourceLanguage(): string
    {
        return $this->sourceLanguage;
    }

    public function setSourceLanguage(string $sourceLanguage): self
    {
        $this->sourceLanguage = $sourceLanguage;
        return $this;
    }

    public function getTargetLanguage(): string
    {
        return $this->targetLanguage;
    }

    public function setTargetLanguage(string $targetLanguage): self
    {
        $this->targetLanguage = $targetLanguage;
        return $this;
    }
}
