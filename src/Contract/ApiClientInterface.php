<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Request\Translation;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Model\Token;

interface ApiClientInterface
{
    public function setToken(Token $token): self;

    public function getToken(): Token;

    public function requestToken(): Token;

    public function checkConnection(): bool;

    public function getReferenceData(): ReferenceData;

    /**
     * @throws ValidationErrorsException
     *   Thrown if there are validation errors.
     */
    public function validateTranslationRequest(Translation $translationRequest): bool;

    /**
     * @throws ValidationErrorsException
     *   Thrown if there are validation errors.
     */
    public function sendTranslationRequest(Translation $translationRequest): string;

    /**
     * @throws ValidationErrorsException
     * *   Thrown if there are validation errors.
     */
    public function getPermanentIdentifier(string $correlationId): string;
}
