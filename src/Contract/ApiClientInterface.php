<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use OpenEuropa\CdtClient\Model\Request\Translation as TranslationRequest;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Model\Response\Translation as TranslationResponse;

interface ApiClientInterface
{
    public function setToken(Token $token): self;

    public function requestToken(): Token;

    public function checkConnection(): bool;

    public function getReferenceData(): ReferenceData;

    /**
     * @throws \OpenEuropa\CdtClient\Exception\ValidationErrorsException
     *   Thrown if there are validation errors.
     */
    public function validateTranslationRequest(TranslationRequest $translationRequest): bool;

    /**
     * @throws \OpenEuropa\CdtClient\Exception\ValidationErrorsException
     *   Thrown if there are validation errors.
     */
    public function sendTranslationRequest(TranslationRequest $translationRequest): string;

    /**
     * @throws \OpenEuropa\CdtClient\Exception\ValidationErrorsException
     *   Thrown if there are validation errors.
     */
    public function getPermanentIdentifier(string $correlationId): string;

    /**
     * @throws \OpenEuropa\CdtClient\Exception\ValidationErrorsException
     *   Thrown if there are validation errors.
     */
    public function getRequestStatus(string $permanentId): TranslationResponse;

    /**
     * @throws \OpenEuropa\CdtClient\Exception\ValidationErrorsException
     *   Thrown if there are validation errors.
     */
    public function downloadFile(string $url): string;
}
