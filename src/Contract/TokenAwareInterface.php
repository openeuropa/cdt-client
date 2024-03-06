<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use OpenEuropa\CdtClient\Model\Token;

interface TokenAwareInterface
{
    public function setToken(Token $token): self;

    public function getToken(): Token;
}
