<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Request\Translation as TranslationRequest;
use OpenEuropa\CdtClient\Model\Response\File;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Model\Response\Translation as TranslationResponse;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;

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
    public function validateTranslationRequest(TranslationRequest $translationRequest): bool;

    /**
     * @throws ValidationErrorsException
     *   Thrown if there are validation errors.
     */
    public function sendTranslationRequest(TranslationRequest $translationRequest): string;

    /**
     * @throws ValidationErrorsException
     * *   Thrown if there are validation errors.
     */
    public function getPermanentIdentifier(string $correlationId): string;

    /**
     * @throws ValidationErrorsException
     * *   Thrown if there are validation errors.
     */
    public function getRequestStatus(string $permanentId): TranslationResponse;

    /**
     * @return array<int, File>
     *
     * @throws ValidationErrorsException
     * *   Thrown if there are validation errors.
     */
    public function getTranslatedFiles(string $permanentId): array;
}
