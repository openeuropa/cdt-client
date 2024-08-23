<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\StringCollection;
use Symfony\Component\Serializer\Annotation\SerializedPath;

/**
 * Class Translation.
 *
 * Represents the translation response that is received to the CDT API.
 */
class Translation
{
    protected string $requestIdentifier;

    protected string $status;

    protected StringCollection $sourceLanguages;

    protected StringCollection $targetLanguages;

    /**
     * @var \DateTimeInterface
     */
    protected \DateTimeInterface $creationDate;

    /**
     * @var \DateTimeInterface|null
     */
    protected ?\DateTimeInterface $deliveryDate = null;

    protected string $title;

    protected string $service;

    protected string $department;

    protected StringCollection $contacts;

    protected StringCollection $deliverToContacts;

    protected SourceDocumentCollection $sourceDocuments;

    protected ReferenceFileCollection $referenceFiles;

    protected FileCollection $bilingualFiles;

    protected FileCollection $targetFiles;

    protected DateCollection $dates;

    protected CommentCollection $comments;

    #[SerializedPath('[pricing][totalPrice]')]
    protected float $totalPrice;

    #[SerializedPath('[pricing][jobSummary]')]
    protected JobSummaryCollection $jobSummary;

    protected bool $isInProgress;

    protected string $clientReference;

    protected string $deliveryModeCode;

    protected string $departmentCode;

    protected string $phoneNumber;

    protected string $purposeCode;

    protected bool $isQuotationOnly;

    #[SerializedPath('[_links]')]
    protected LinkCollection $links;

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

    public function getTargetLanguages(): StringCollection
    {
        return $this->targetLanguages;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\StringCollection|array<int, string> $targetLanguages
     */
    public function setTargetLanguages(StringCollection|array $targetLanguages): self
    {
        $this->targetLanguages = is_array($targetLanguages) ? new StringCollection($targetLanguages) : $targetLanguages;

        return $this;
    }

    public function getCreationDate(): \DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;

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

    public function getService(): string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function setDepartment(string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getContacts(): StringCollection
    {
        return $this->contacts;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\StringCollection|array<int, string> $contacts
     */
    public function setContacts(StringCollection|array $contacts): self
    {
        $this->contacts = is_array($contacts) ? new StringCollection($contacts) : $contacts;

        return $this;
    }

    public function getDeliverToContacts(): StringCollection
    {
        return $this->deliverToContacts;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\StringCollection|array<int, string> $deliverToContacts
     */
    public function setDeliverToContacts(StringCollection|array $deliverToContacts): self
    {
        $this->deliverToContacts = is_array($deliverToContacts) ? new StringCollection($deliverToContacts) : $deliverToContacts;

        return $this;
    }

    public function getSourceDocuments(): SourceDocumentCollection
    {
        return $this->sourceDocuments;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\SourceDocumentCollection|array<int, \OpenEuropa\CdtClient\Model\Response\SourceDocument> $sourceDocuments
     */
    public function setSourceDocuments(SourceDocumentCollection|array $sourceDocuments): self
    {
        $this->sourceDocuments = is_array($sourceDocuments) ? new SourceDocumentCollection($sourceDocuments) : $sourceDocuments;

        return $this;
    }

    public function getReferenceFiles(): ReferenceFileCollection
    {
        return $this->referenceFiles;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\ReferenceFileCollection|array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceFile> $referenceFiles
     */
    public function setReferenceFiles(ReferenceFileCollection|array $referenceFiles): self
    {
        $this->referenceFiles = is_array($referenceFiles) ? new ReferenceFileCollection($referenceFiles) : $referenceFiles;

        return $this;
    }

    public function getBilingualFiles(): FileCollection
    {
        return $this->bilingualFiles;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\FileCollection|array<int, \OpenEuropa\CdtClient\Model\Response\File> $bilingualFiles
     */
    public function setBilingualFiles(FileCollection|array $bilingualFiles): self
    {
        $this->bilingualFiles = is_array($bilingualFiles) ? new FileCollection($bilingualFiles) : $bilingualFiles;

        return $this;
    }

    public function getTargetFiles(): FileCollection
    {
        return $this->targetFiles;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\FileCollection|array<int, \OpenEuropa\CdtClient\Model\Response\File> $targetFiles
     */
    public function setTargetFiles(FileCollection|array $targetFiles): self
    {
        $this->targetFiles = is_array($targetFiles) ? new FileCollection($targetFiles) : $targetFiles;

        return $this;
    }

    public function getDates(): DateCollection
    {
        return $this->dates;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\DateCollection|array<int, \OpenEuropa\CdtClient\Model\Response\Date> $dates
     */
    public function setDates(DateCollection|array $dates): self
    {
        $this->dates = is_array($dates) ? new DateCollection($dates) : $dates;

        return $this;
    }

    public function getComments(): CommentCollection
    {
        return $this->comments;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\CommentCollection|array<int, \OpenEuropa\CdtClient\Model\Response\Comment> $comments
     */
    public function setComments(CommentCollection|array $comments): self
    {
        $this->comments = is_array($comments) ? new CommentCollection($comments) : $comments;

        return $this;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getJobSummary(): JobSummaryCollection
    {
        return $this->jobSummary;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\JobSummaryCollection|array<int, \OpenEuropa\CdtClient\Model\Response\JobSummary> $jobSummary
     */
    public function setJobSummary(JobSummaryCollection|array $jobSummary): self
    {
        $this->jobSummary = is_array($jobSummary) ? new JobSummaryCollection($jobSummary) : $jobSummary;

        return $this;
    }

    public function isInProgress(): bool
    {
        return $this->isInProgress;
    }

    public function setIsInProgress(bool $isInProgress): self
    {
        $this->isInProgress = $isInProgress;

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

    public function getDeliveryModeCode(): string
    {
        return $this->deliveryModeCode;
    }

    public function setDeliveryModeCode(string $deliveryModeCode): self
    {
        $this->deliveryModeCode = $deliveryModeCode;

        return $this;
    }

    public function getDepartmentCode(): string
    {
        return $this->departmentCode;
    }

    public function setDepartmentCode(string $departmentCode): self
    {
        $this->departmentCode = $departmentCode;

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

    public function getPurposeCode(): string
    {
        return $this->purposeCode;
    }

    public function setPurposeCode(string $purposeCode): self
    {
        $this->purposeCode = $purposeCode;

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

    public function getLinks(): LinkCollection
    {
        return $this->links;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\LinkCollection|array<string, \OpenEuropa\CdtClient\Model\Response\Link> $links
     */
    public function setLinks(LinkCollection|array $links): self
    {
        $this->links = is_array($links) ? new LinkCollection($links) : $links;

        return $this;
    }
}
