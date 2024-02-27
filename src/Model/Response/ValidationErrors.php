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
     * The errors.
     *
     * @var array<string, array<int, string>>
     */
    protected array $errors;

    /**
     * The global message.
     */
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
     *
     * @return self
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
