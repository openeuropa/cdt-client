<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\Token;

trait TokenAwareTrait
{
    private Token $token;

    /**
     * @inheritDoc
     */
    public function setToken(Token $token): void
    {
        $this->token = $token;
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
        return [
            'Authorization' => "{$this->token->getTokenType()} {$this->token->getAccessToken()}",
        ] + parent::getRequestHeaders();
    }
}
