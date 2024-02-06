<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use OpenEuropa\CdtClient\Model\Token;

interface TokenAwareInterface
{
    /**
     * @param Token $token
     */
    public function setToken(Token $token): void;

    /**
     * @return Token
     */
    public function getToken(): Token;
}
