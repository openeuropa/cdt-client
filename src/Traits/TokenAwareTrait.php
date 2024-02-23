<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\Token;

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

    /**
     * @inheritDoc
     */
    public function setToken(Token $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getToken(): Token
    {
        return $this->token;
    }

    /**
     * @inheritDoc
     */
    public function getRequestHeaders(): array
    {
        $tokenType = ucfirst(strtolower($this->token->getTokenType()));
        return [
            'Authorization' => "$tokenType {$this->token->getAccessToken()}",
        ] + parent::getRequestHeaders();
    }
}
