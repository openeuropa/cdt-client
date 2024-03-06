<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

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

    /**
     * @var array<int, string>
     */
    protected array $sourceLanguages;

    /**
     * @var array<int, string>
     */
    protected array $targetLanguages;

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

    /**
     * @var array<int, string>
     */
    protected array $contacts;

    /**
     * @var array<int, string>
     */
    protected array $deliverToContacts;

    /**
     * @var array<int, SourceDocument>
     */
    protected array $sourceDocuments;

    /**
     * @var array<int, ReferenceFile>
     */
    protected array $referenceFiles;

    /**
     * @var array<int, File>
     */
    protected array $bilingualFiles;

    /**
     * @var array<int, File>
     */
    protected array $targetFiles;

    /**
     * @var array<int, Date>
     */
    protected array $dates;

    /**
     * @var array<int, Comment>
     */
    protected array $comments;

    #[SerializedPath('[pricing][totalPrice]')]
    protected float $totalPrice;

    /**
     * @var array<int, JobSummary>
     */
    #[SerializedPath('[pricing][jobSummary]')]
    protected array $jobSummary;

    protected bool $isInProgress;

    protected string $clientReference;

    protected string $deliveryModeCode;

    protected string $departmentCode;

    protected string $phoneNumber;

    protected string $purposeCode;

    protected bool $isQuotationOnly;

    /**
     * @var array<string, Link>
     */
    #[SerializedPath('[_links]')]
    protected array $links;

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

    /**
     * @return array<int, string>
     */
    public function getSourceLanguages(): array
    {
        return $this->sourceLanguages;
    }

    /**
     * @param array<int, string> $sourceLanguages
     */
    public function setSourceLanguages(array $sourceLanguages): self
    {
        $this->sourceLanguages = $sourceLanguages;
        return $this;
    }

    /**
     * @return array<int, string>
     */
    public function getTargetLanguages(): array
    {
        return $this->targetLanguages;
    }

    /**
     * @param array<int, string> $targetLanguages
     */
    public function setTargetLanguages(array $targetLanguages): self
    {
        $this->targetLanguages = $targetLanguages;
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

    /**
     * @return array<int, string>
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * @param array<int, string> $contacts
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = $contacts;
        return $this;
    }

    /**
     * @return array<int, string>
     */
    public function getDeliverToContacts(): array
    {
        return $this->deliverToContacts;
    }

    /**
     * @param array<int, string> $deliverToContacts
     */
    public function setDeliverToContacts(array $deliverToContacts): self
    {
        $this->deliverToContacts = $deliverToContacts;
        return $this;
    }

    /**
     * @return array<int, SourceDocument>
     */
    public function getSourceDocuments(): array
    {
        return $this->sourceDocuments;
    }

    /**
     * @param array<int, SourceDocument> $sourceDocuments
     */
    public function setSourceDocuments(array $sourceDocuments): self
    {
        $this->sourceDocuments = $sourceDocuments;
        return $this;
    }

    /**
     * @return array<int, ReferenceFile>
     */
    public function getReferenceFiles(): array
    {
        return $this->referenceFiles;
    }

    /**
     * @param array<int, ReferenceFile> $referenceFiles
     */
    public function setReferenceFiles(array $referenceFiles): self
    {
        $this->referenceFiles = $referenceFiles;
        return $this;
    }

    /**
     * @return array<int, File>
     */
    public function getBilingualFiles(): array
    {
        return $this->bilingualFiles;
    }

    /**
     * @param array<int, File> $bilingualFiles
     */
    public function setBilingualFiles(array $bilingualFiles): self
    {
        $this->bilingualFiles = $bilingualFiles;
        return $this;
    }

    /**
     * @return array<int, File>
     */
    public function getTargetFiles(): array
    {
        return $this->targetFiles;
    }

    /**
     * @param array<int, File> $targetFiles
     */
    public function setTargetFiles(array $targetFiles): self
    {
        $this->targetFiles = $targetFiles;
        return $this;
    }

    /**
     * @return array<int, Date>
     */
    public function getDates(): array
    {
        return $this->dates;
    }

    /**
     * @param array<int, Date> $dates
     */
    public function setDates(array $dates): self
    {
        $this->dates = $dates;
        return $this;
    }

    /**
     * @return array<int, Comment>
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param array<int, Comment> $comments
     */
    public function setComments(array $comments): self
    {
        $this->comments = $comments;
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

    /**
     * @return array<int, JobSummary>
     */
    public function getJobSummary(): array
    {
        return $this->jobSummary;
    }

    /**
     * @param array<int, JobSummary> $jobSummary
     */
    public function setJobSummary(array $jobSummary): self
    {
        $this->jobSummary = $jobSummary;
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

    /**
     * @return array<string, Link>
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param array<string, Link> $links
     */
    public function setLinks(array $links): self
    {
        $this->links = $links;
        return $this;
    }
}
