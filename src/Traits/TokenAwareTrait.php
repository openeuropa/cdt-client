<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\Response\Token;

/**
 * Trait TokenAwareTrait
 *
 * Provides methods for handling an authentication token and defines request headers needed for endpoints that need
 * authentication.
 *
 * @see Token
 */
trait TokenAwareTrait
{
    private Token $token;

    public function setToken(Token $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function getToken(): Token
    {
        return $this->token;
    }

    /**
     * @return array<string, string>
     */
    public function getAuthorizationHeaders(): array
    {
        assert(isset($this->token), 'No token has been set.');
        $tokenType = ucfirst(strtolower($this->token->getTokenType()));

        return [
            'Authorization' => sprintf('%s %s', $tokenType, $this->token->getAccessToken()),
        ];
    }
}
