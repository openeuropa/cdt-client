<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient;

use OpenEuropa\CdtClient\Contract\ApiClientInterface;
use OpenEuropa\CdtClient\Endpoint\IdentifierEndpoint;
use OpenEuropa\CdtClient\Endpoint\MainEndpoint;
use OpenEuropa\CdtClient\Endpoint\ReferenceDataEndpoint;
use OpenEuropa\CdtClient\Endpoint\RequestsEndpoint;
use OpenEuropa\CdtClient\Endpoint\StatusEndpoint;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Endpoint\ValidateEndpoint;
use OpenEuropa\CdtClient\Http\Rest;
use OpenEuropa\CdtClient\Model\Request\Translation as TranslationRequest;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Model\Response\Translation as TranslationResponse;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Traits\ConfigurationAwareTrait;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Class ApiClient
 *
 * Provides a centralized client for interacting with the CDT API.
 * It handles requesting and setting up what is necessary to execute calls to the endpoints.
 *
 * @see ApiClientInterface
 * @see ConfigurationAwareTrait
 */
class ApiClient implements ApiClientInterface
{
    protected Token $token;

    protected ApiFactory $apiFactory;

    /**
     * @param array<string, mixed> $configuration
     */
    public function __construct(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        array $configuration
    ) {
        $this->apiFactory = new ApiFactory(new Rest(
            $httpClient,
            $requestFactory,
            $streamFactory
        ), $configuration);
    }

    public function requestToken(): Token
    {
        /** @var TokenEndpoint $endpoint */
        $endpoint = $this->apiFactory->createEndpoint(TokenEndpoint::class);

        return $endpoint->getToken();
    }

    public function checkConnection(): bool
    {
        /** @var MainEndpoint $endpoint */
        $endpoint = $this->apiFactory->createEndpoint(MainEndpoint::class);

        return $endpoint
            ->setToken($this->getToken())
            ->isConnected();
    }

    public function getReferenceData(): ReferenceData
    {
        /** @var ReferenceDataEndpoint $endpoint */
        $endpoint = $this->apiFactory->createEndpoint(ReferenceDataEndpoint::class);

        return $endpoint
            ->setToken($this->getToken())
            ->getReferenceData();
    }

    /**
     * @inheritDoc
     */
    public function validateTranslationRequest(TranslationRequest $translationRequest): bool
    {
        /** @var ValidateEndpoint $endpoint */
        $endpoint = $this->apiFactory->createEndpoint(ValidateEndpoint::class);

        return $endpoint
            ->setToken($this->getToken())
            ->validateTranslationRequest($translationRequest);
    }

    public function sendTranslationRequest(TranslationRequest $translationRequest): string
    {
        /** @var RequestsEndpoint $endpoint */
        $endpoint = $this->apiFactory->createEndpoint(RequestsEndpoint::class);

        return $endpoint
            ->setToken($this->getToken())
            ->sendTranslationRequest($translationRequest);
    }

    /**
     * @inheritDoc
     */
    public function getPermanentIdentifier(string $correlationId): string
    {
        /** @var IdentifierEndpoint $endpoint */
        $endpoint = $this->apiFactory->createEndpoint(IdentifierEndpoint::class);

        return $endpoint
            ->setToken($this->getToken())
            ->getPermanentIdentifier($correlationId);
    }

    /**
     * @inheritDoc
     */
    public function getRequestStatus(string $permanentId): TranslationResponse
    {
        /** @var StatusEndpoint $endpoint */
        $endpoint = $this->apiFactory->createEndpoint(StatusEndpoint::class);

        return $endpoint
            ->setToken($this->getToken())
            ->getTranslationRequestStatus($permanentId);
    }

    public function downloadFile(string $url): string
    {
        $downloader = $this->apiFactory->createDownload();

        return $downloader
            ->setToken($this->getToken())
            ->downloadFile($url);
    }

    public function setToken(Token $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function getToken(): Token
    {
        return $this->token;
    }
}
