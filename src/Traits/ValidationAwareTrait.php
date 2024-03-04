<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Traits;

use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Response\ValidationErrors;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait ValidationAwareTrait
 *
 * Provides methods for handling endpoints that may return 400 code with validation errors.
 *
 * @see ValidationErrorsException
 */
trait ValidationAwareTrait
{
    protected function handleResponseException(ResponseInterface $response): void
    {
        if ($response->getStatusCode() === 400) {
            $validationErrors = $this->getSerializer()->deserialize(
                $response->getBody()->__toString(),
                ValidationErrors::class,
                'json'
            );
            throw new ValidationErrorsException(
                'The API endpoint returned 400 response with validation errors.',
                0,
                null,
                $validationErrors
            );
        } else {
            parent::handleResponseException($response);
        }
    }
}
