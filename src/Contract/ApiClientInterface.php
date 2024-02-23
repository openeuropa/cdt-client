<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use OpenEuropa\CdtClient\Model\Token;

interface ApiClientInterface
{
    /**
     * @param Token $token
     */
    public function setToken(Token $token): self;

    /**
     * @return Token
     */
    public function getToken(): Token;

    /**
     * @return Token
     */
    public function requestToken(): Token;

    /**
     * @return bool
     */
    public function checkConnection(): bool;
}
