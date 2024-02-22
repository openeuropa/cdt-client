<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Callback;

/**
 * Class RequestStatus.
 *
 * Represents the single callback sent to the defined endpoint
 * @todo all properties are Uppercase in the request.
 */
class RequestStatus
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
     * The request date.
     */
    protected \DateTimeInterface $date;

    /**
     * The correlation ID.
     */
    protected string $correlationId;
}
