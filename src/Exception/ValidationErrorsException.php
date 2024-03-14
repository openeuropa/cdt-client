<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Exception;

use OpenEuropa\CdtClient\Model\Response\ValidationErrors;

/**
 * Thrown when an API endpoint call returns an error message containing validation messages.
 */
class ValidationErrorsException extends \RuntimeException
{
    public function __construct(string $message, int $code, ?\Throwable $previous, protected ValidationErrors $validationErrors)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getValidationErrors(): ValidationErrors
    {
        return $this->validationErrors;
    }
}
