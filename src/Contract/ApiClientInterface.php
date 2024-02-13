<?php

declare(strict_types = 1);

namespace OpenEuropa\CdtClient\Contract;

use OpenEuropa\CdtClient\Model\Token;

interface ApiClientInterface
{
    /**
     * @return Token
     */
    public function requestToken(): Token;

    /**
     * @return bool
     */
    public function checkConnection(): bool;
}
