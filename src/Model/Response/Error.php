<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

/**
 * Class Error.
 *
 * Represents the error response received from the CDT API.
 * Used by many endpoints to return error messages.
 */
class Error
{
    /**
     * The errors.
     *
     * @var array<string, array<int, string>>
     */
    protected array $errors;

    /**
     * The global message.
     */
    protected string $message;
}
