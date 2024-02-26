<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Model\Response\Token;

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

    /**
     * @return ReferenceData
     */
    public function getReferenceData(): ReferenceData;
}
