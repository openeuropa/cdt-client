<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\Annotation\SerializedPath;

/**
 * Class Translation.
 *
 * Represents the translation response that is received to the CDT API.
 * Stores the translation details, but without the actual content.
 */
class Translation
{
    /**
     * The request identifier.
     */
    protected string $requestIdentifier;

    /**
     * The status.
     */
    protected string $status;

    /**
     * The source languages.
     * @var string[]
     */
    protected array $sourceLanguages;

    /**
     * The target languages.
     * @var string[]
     */
    protected array $targetLanguages;

    /**
     * The creation date.
     */
    protected \DateTimeInterface $creationDate;

    /**
     * The delivery date.
     */
    protected \DateTimeInterface $deliveryDate;

    /**
     * The title.
     */
    protected string $title;

    /**
     * The service.
     */
    protected string $service;

    /**
     * The department.
     */
    protected string $department;

    /**
     * The contacts.
     * @var string[]
     */
    protected array $contacts;

    /**
     * Deliver to contacts.
     * @var string[]
     */
    protected array $deliverToContacts;

    /**
     * The source documents.
     * @var SourceDocument[]
     */
    protected array $sourceDocuments;

    /**
     * The reference files.
     * @var ReferenceFile[]
     */
    protected array $referenceFiles;

    /**
     * The bilingual files.
     * @var File[]
     */
    protected array $bilingualFiles;

    /**
     * The target files.
     * @var File[]
     */
    protected array $targetFiles;

    /**
     * The dates.
     * @var Date[]
     */
    protected array $dates;

    /**
     * The comments.
     * @var Comment[]
     */
    protected array $comments;

    /**
     * The total price.
     * @todo Should be float or decimal?
     */
    #[SerializedPath('[pricing][totalPrice]')]
    protected int $totalPrice;

    /**
     * The job summary.
     *
     * @var JobSummary[]
     */
    #[SerializedPath('[pricing][jobSummary]')]
    protected array $jobSummary;

    /**
     * Is in progress.
     */
    protected bool $isInProgress;

    /**
     * The client reference.
     */
    protected string $clientReference;

    /**
     * The delivery mode code.
     */
    protected string $deliveryModeCode;

    /**
     * The department code.
     */
    protected string $departmentCode;

    /**
     * The phone number.
     */
    protected string $phoneNumber;

    /**
     * The purpose code.
     */
    protected string $purposeCode;

    /**
     * Is quotation only.
     */
    protected bool $isQuotationOnly;

    /**
     * The links.
     *
     * @var Link[]
     */
    #[SerializedName('_links')]
    protected array $links;
}
