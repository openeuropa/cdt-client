<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Thrown when an API endpoint call returns a status code other than 200.
 */
class InvalidStatusCodeException extends \RuntimeException
{
    public function __construct(string $message, int $code, ?\Throwable $previous, protected ResponseInterface $response)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
