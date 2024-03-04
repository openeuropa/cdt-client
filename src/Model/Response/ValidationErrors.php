<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

/**
 * Class ValidationErrors.
 *
 * Represents the error response received from the CDT API.
 * Used by many endpoints to return error messages.
 */
class ValidationErrors
{
    /**
     * @var array<string, array<int, string>>
     */
    protected array $errors;

    protected string $message;

    /**
     * @return array<string, array<int, string>>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array<string, array<int, string>> $errors
     */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }
}
