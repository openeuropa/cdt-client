<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Callback;

/**
 * Class JobStatus.
 *
 * Represents the single callback sent to the defined endpoint
 */
class JobStatus
{
    protected string $requestIdentifier;

    protected string $status;

    protected string $sourceDocumentName;

    protected string $sourceLanguageCode;

    protected string $targetLanguageCode;

    public function getRequestIdentifier(): string
    {
        return $this->requestIdentifier;
    }

    public function setRequestIdentifier(string $requestIdentifier): self
    {
        $this->requestIdentifier = $requestIdentifier;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getSourceDocumentName(): string
    {
        return $this->sourceDocumentName;
    }

    public function setSourceDocumentName(string $sourceDocumentName): self
    {
        $this->sourceDocumentName = $sourceDocumentName;
        return $this;
    }

    public function getSourceLanguageCode(): string
    {
        return $this->sourceLanguageCode;
    }

    public function setSourceLanguageCode(string $sourceLanguageCode): self
    {
        $this->sourceLanguageCode = $sourceLanguageCode;
        return $this;
    }

    public function getTargetLanguageCode(): string
    {
        return $this->targetLanguageCode;
    }

    public function setTargetLanguageCode(string $targetLanguageCode): self
    {
        $this->targetLanguageCode = $targetLanguageCode;
        return $this;
    }
}
