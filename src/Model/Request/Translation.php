<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use Symfony\Component\Serializer\Annotation\SerializedPath;

/**
 * Class Translation.
 *
 * Represents the translation request that is sent to the CDT API.
 */
class Translation
{
    /**
     * The department code from the ReferenceData.
     */
    protected string $departmentCode;

    /**
     * The contact names.
     *
     * @var string[]
     */
    protected array $contactUserNames;

    /**
     * The delivery contact usernames.
     *
     * @var string[]
     */
    protected array $deliveryContactUsernames;

    /**
     * The phone number.
     */
    protected string $phoneNumber;

    /**
     * The title.
     */
    protected string $title;

    /**
     * The client reference.
     */
    protected string $clientReference;

    /**
     * The purpose code from the ReferenceData.
     */
    protected string $purposeCode;

    /**
     * The priority code from the ReferenceData.
     */
    protected string $priorityCode;

    /**
     * The delivery mode code from the ReferenceData.
     */
    protected string $deliveryModeCode;

    /**
     * The comments.
     */
    protected string $comments;

    /**
     * The reference URLs.
     */
    #[SerializedPath('[referenceSet][urls]')]
    protected ReferenceUrlCollection $referenceSetUrls;

    /**
     * The reference files.
     */
    #[SerializedPath('[referenceSet][files]')]
    protected ReferenceFileCollection $referenceSetFiles;

    /**
     * The source documents.
     */
    protected SourceDocumentCollection $sourceDocuments;

    /**
     * The send options from the ReferenceData.
     */
    protected string $sendOptions;

    /**
     * The service from the ReferenceData.
     */
    protected string $service;

    /**
     * Is it a quotation only?
     */
    protected bool $isQuotationOnly;

    /**
     * The callbacks.
     */
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

    /**
     * @return string[]
     */
    public function getContactUserNames(): array
    {
        return $this->contactUserNames;
    }

    /**
     * @param string[] $contactUserNames
     * @return self
     */
    public function setContactUserNames(array $contactUserNames): self
    {
        $this->contactUserNames = $contactUserNames;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getDeliveryContactUsernames(): array
    {
        return $this->deliveryContactUsernames;
    }

    /**
     * @param string[] $deliveryContactUsernames
     * @return self
     */
    public function setDeliveryContactUsernames(array $deliveryContactUsernames): self
    {
        $this->deliveryContactUsernames = $deliveryContactUsernames;
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

    public function setReferenceSetUrls(ReferenceUrlCollection $referenceSetUrls): self
    {
        $this->referenceSetUrls = $referenceSetUrls;
        return $this;
    }

    public function getReferenceSetFiles(): ReferenceFileCollection
    {
        return $this->referenceSetFiles;
    }

    public function setReferenceSetFiles(ReferenceFileCollection $referenceSetFiles): self
    {
        $this->referenceSetFiles = $referenceSetFiles;
        return $this;
    }

    public function getSourceDocuments(): SourceDocumentCollection
    {
        return $this->sourceDocuments;
    }

    public function setSourceDocuments(SourceDocumentCollection $sourceDocuments): self
    {
        $this->sourceDocuments = $sourceDocuments;
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

    public function setCallbacks(CallbackCollection $callbacks): self
    {
        $this->callbacks = $callbacks;
        return $this;
    }
}
