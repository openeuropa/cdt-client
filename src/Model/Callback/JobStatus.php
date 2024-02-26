<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Callback;

/**
 * Class JobStatus.
 *
 * Represents the single callback sent to the defined endpoint
 * @todo all properties are Uppercase in the request.
 */
class JobStatus
{
    /**
     * The request identifier.
     */
    protected string $requestIdentifier;

    /**
     * The request status.
     * @todo create some enums?
     */
    protected string $status;

    /**
     * The source document name.
     */
    protected string $sourceDocumentName;

    /**
     * The source language code.
     */
    protected string $sourceLanguageCode;

    /**
     * The target language code.
     */
    protected string $targetLanguageCode;
}
