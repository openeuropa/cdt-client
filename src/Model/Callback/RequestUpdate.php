<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Callback;

/**
 * Class RequestUpdate.
 *
 * Represents the single callback sent to the defined endpoint
 * @todo all properties are Uppercase in the request.
 */
class RequestUpdate
{

    /**
     * The request identifier.
     */
    protected string $requestIdentifier;

    /**
     * The request id.
     */
    protected string $requestId;

    /**
     * The job id.
     */
    protected string $jobId;

    /**
     * The source language.
     */
    protected string $sourceLanguage;

    /**
     * The target language.
     */
    protected string $targetLanguage;

    /**
     * The document name.
     */
    protected string $documentName;

    /**
     * The update type.
     * @todo create some enums?
     */
    protected string $updateType;

    /**
     * The property changes.
     */
    protected array $propertiesChanges;
}
