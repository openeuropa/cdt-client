<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Callback;

/**
 * Class RequestUpdate.
 *
 * Represents the single callback sent to the defined endpoint
 */
class RequestUpdate
{
    protected string $requestIdentifier;

    protected string $requestId;

    protected string $jobId;

    protected string $sourceLanguage;

    protected string $targetLanguage;

    protected string $documentName;

    protected string $updateType;

    /**
     * @var array<mixed>
     */
    protected array $propertiesChanges;

    public function getRequestIdentifier(): string
    {
        return $this->requestIdentifier;
    }

    public function setRequestIdentifier(string $requestIdentifier): self
    {
        $this->requestIdentifier = $requestIdentifier;
        return $this;
    }

    public function getRequestId(): string
    {
        return $this->requestId;
    }

    public function setRequestId(string $requestId): self
    {
        $this->requestId = $requestId;
        return $this;
    }

    public function getJobId(): string
    {
        return $this->jobId;
    }

    public function setJobId(string $jobId): self
    {
        $this->jobId = $jobId;
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

    public function getDocumentName(): string
    {
        return $this->documentName;
    }

    public function setDocumentName(string $documentName): self
    {
        $this->documentName = $documentName;
        return $this;
    }

    public function getUpdateType(): string
    {
        return $this->updateType;
    }

    public function setUpdateType(string $updateType): self
    {
        $this->updateType = $updateType;
        return $this;
    }

    /**
     * @return array<mixed>
     */
    public function getPropertiesChanges(): array
    {
        return $this->propertiesChanges;
    }

    /**
     * @param array<mixed> $propertiesChanges
     */
    public function setPropertiesChanges(array $propertiesChanges): self
    {
        $this->propertiesChanges = $propertiesChanges;
        return $this;
    }
}
