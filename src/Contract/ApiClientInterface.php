<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Request\Translation;
use OpenEuropa\CdtClient\Model\Token;

interface ApiClientInterface
{
    public function setToken(Token $token): self;

    public function getToken(): Token;

    public function requestToken(): Token;

    public function checkConnection(): bool;

    /**
     * @throws ValidationErrorsException
     *   Thrown if there are validation errors.
     */
    public function validateTranslationRequest(Translation $translationRequest): bool;

    /**
     * @throws ValidationErrorsException
     */
    public function sendTranslationRequest(Translation $translationRequest): string;
}
