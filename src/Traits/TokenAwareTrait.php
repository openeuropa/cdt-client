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
 * @see \OpenEuropa\CdtClient\Model\Response\Token
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

    public function getRequestHeaders(): array
    {
        $tokenType = ucfirst(strtolower($this->token->getTokenType()));
        return [
            'Authorization' => "$tokenType {$this->token->getAccessToken()}",
        ] + parent::getRequestHeaders();
    }
}
