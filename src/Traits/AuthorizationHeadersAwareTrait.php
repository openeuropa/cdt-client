<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\Response\Token;

/**
 * Trait AuthorizationHeadersAwareTrait
 *
 * Provides methods for handling authorization headers.
 */
trait AuthorizationHeadersAwareTrait
{
    /**
     * @return array<string, string>
     */
    public function getAuthorizationHeaders(?Token $token): array
    {
        if (null === $token) {
            throw new \RuntimeException('No token provided for authorization headers.');
        }

        return [
            'Authorization' => sprintf('%s %s', ucfirst(strtolower($token->getTokenType())), $token->getAccessToken()),
        ];
    }
}
