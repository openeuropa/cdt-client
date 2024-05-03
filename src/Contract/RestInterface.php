<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use Psr\Http\Message\ResponseInterface;

interface RestInterface
{
    /**
     * @param array<string, mixed> $headers
     */
    public function get(string $uri, array $headers = []): ResponseInterface;

    /**
     * @param array<string, mixed> $headers
     */
    public function postJson(string $uri, string $jsonBody, array $headers = []): ResponseInterface;

    /**
     * @param array<string, mixed> $headers
     * @param array<string, string> $formFields
     */
    public function postForm(string $uri, array $formFields, array $headers = []): ResponseInterface;
}
