<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\StringCollection;
use Symfony\Component\Serializer\Annotation\SerializedPath;

/**
 * Class Translation.
 *
 * Represents the translation request that is sent to the CDT API.
 */
class Translation
{
    protected string $departmentCode;

    protected StringCollection $contactUserNames;

    protected StringCollection $deliveryContactUsernames;

    protected string $phoneNumber;

    protected string $title;

    protected string $clientReference;

    protected string $purposeCode;

    protected string $priorityCode;

    protected string $deliveryModeCode;

    protected string $comments;

    #[SerializedPath('[referenceSet][urls]')]
    protected ReferenceUrlCollection $referenceSetUrls;

    #[SerializedPath('[referenceSet][files]')]
    protected ReferenceFileCollection $referenceSetFiles;

    protected SourceDocumentCollection $sourceDocuments;

    protected string $sendOptions;

    protected string $service;

    protected bool $isQuotationOnly;

    protected CallbackCollection $callbacks;

    public function getDepartmentCode(): string
    {
        return $this->departmentCode;
    }

    public function setDepartmentCode(string $departmentCode): self
    {
        $this->departmentCode = $departmentCode;

        return $this;
    }

    public function getContactUserNames(): StringCollection
    {
        return $this->contactUserNames;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\StringCollection|array<int, string> $contactUserNames
     */
    public function setContactUserNames(StringCollection|array $contactUserNames): self
    {
        $this->contactUserNames = is_array($contactUserNames) ? new StringCollection($contactUserNames) : $contactUserNames;

        return $this;
    }

    public function getDeliveryContactUsernames(): StringCollection
    {
        return $this->deliveryContactUsernames;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\StringCollection|array<int, string> $deliveryContactUsernames
     */
    public function setDeliveryContactUsernames(StringCollection|array $deliveryContactUsernames): self
    {
        $this->deliveryContactUsernames = is_array($deliveryContactUsernames) ? new StringCollection($deliveryContactUsernames) : $deliveryContactUsernames;

        return $this;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getClientReference(): string
    {
        return $this->clientReference;
    }

    public function setClientReference(string $clientReference): self
    {
        $this->clientReference = $clientReference;

        return $this;
    }

    public function getPurposeCode(): string
    {
        return $this->purposeCode;
    }

    public function setPurposeCode(string $purposeCode): self
    {
        $this->purposeCode = $purposeCode;

        return $this;
    }

    public function getPriorityCode(): string
    {
        return $this->priorityCode;
    }

    public function setPriorityCode(string $priorityCode): self
    {
        $this->priorityCode = $priorityCode;

        return $this;
    }

    public function getDeliveryModeCode(): string
    {
        return $this->deliveryModeCode;
    }

    public function setDeliveryModeCode(string $deliveryModeCode): self
    {
        $this->deliveryModeCode = $deliveryModeCode;

        return $this;
    }

    public function getComments(): string
    {
        return $this->comments;
    }

    public function setComments(string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getReferenceSetUrls(): ReferenceUrlCollection
    {
        return $this->referenceSetUrls;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection|array<int, \OpenEuropa\CdtClient\Model\Request\ReferenceUrl> $referenceSetUrls
     */
    public function setReferenceSetUrls(ReferenceUrlCollection|array $referenceSetUrls): self
    {
        $this->referenceSetUrls = is_array($referenceSetUrls) ? new ReferenceUrlCollection($referenceSetUrls) : $referenceSetUrls;

        return $this;
    }

    public function getReferenceSetFiles(): ReferenceFileCollection
    {
        return $this->referenceSetFiles;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection|array<int, \OpenEuropa\CdtClient\Model\Request\ReferenceFile> $referenceSetFiles
     */
    public function setReferenceSetFiles(ReferenceFileCollection|array $referenceSetFiles): self
    {
        $this->referenceSetFiles = is_array($referenceSetFiles) ? new ReferenceFileCollection($referenceSetFiles) : $referenceSetFiles;

        return $this;
    }

    public function getSourceDocuments(): SourceDocumentCollection
    {
        return $this->sourceDocuments;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection|array<int, \OpenEuropa\CdtClient\Model\Request\SourceDocument> $sourceDocuments
     */
    public function setSourceDocuments(SourceDocumentCollection|array $sourceDocuments): self
    {
        $this->sourceDocuments = is_array($sourceDocuments) ? new SourceDocumentCollection($sourceDocuments) : $sourceDocuments;

        return $this;
    }

    public function getSendOptions(): string
    {
        return $this->sendOptions;
    }

    public function setSendOptions(string $sendOptions): self
    {
        $this->sendOptions = $sendOptions;

        return $this;
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function isQuotationOnly(): bool
    {
        return $this->isQuotationOnly;
    }

    public function setIsQuotationOnly(bool $isQuotationOnly): self
    {
        $this->isQuotationOnly = $isQuotationOnly;

        return $this;
    }

    public function getCallbacks(): CallbackCollection
    {
        return $this->callbacks;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Request\CallbackCollection|array<int, \OpenEuropa\CdtClient\Model\Request\Callback> $callbacks
     */
    public function setCallbacks(CallbackCollection|array $callbacks): self
    {
        $this->callbacks = is_array($callbacks) ? new CallbackCollection($callbacks) : $callbacks;

        return $this;
    }
}
