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
     *
     * @var ReferenceUrl[]
     */
    #[SerializedPath('[referenceSet][urls]')]
    protected array $referenceSetUrls;

    /**
     * The reference files.
     *
     * @var ReferenceFile[]
     */
    #[SerializedPath('[referenceSet][files]')]
    protected array $referenceSetFiles;

    /**
     * The source documents.
     *
     * @var SourceDocument[]
     */
    protected array $sourceDocuments;

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
     *
     * @var Callback[]
     */
    protected array $callbacks;
}
