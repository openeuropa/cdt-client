<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient;

use League\Container\Argument\LiteralArgument;
use League\Container\Container;
use OpenEuropa\CdtClient\Contract\ApiClientInterface;
use OpenEuropa\CdtClient\Endpoint\IdentifierEndpoint;
use OpenEuropa\CdtClient\Endpoint\MainEndpoint;
use OpenEuropa\CdtClient\Endpoint\ReferenceDataEndpoint;
use OpenEuropa\CdtClient\Endpoint\RequestsEndpoint;
use OpenEuropa\CdtClient\Endpoint\StatusEndpoint;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Endpoint\ValidateEndpoint;
use OpenEuropa\CdtClient\Http\Download;
use OpenEuropa\CdtClient\Http\Rest;
use OpenEuropa\CdtClient\Model\Request\Translation as TranslationRequest;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Model\Response\Translation as TranslationResponse;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Traits\ConfigurationAwareTrait;
use Psr\Container\ContainerInterface;
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
    use ConfigurationAwareTrait;

    protected ContainerInterface $container;

    protected Token $token;

    /**
     * @param array<string, mixed> $configuration
     */
    public function __construct(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        array $configuration
    ) {
        $this->configuration = $configuration;
        $this->createContainer(
            $httpClient,
            $requestFactory,
            $streamFactory
        );
    }

    public function requestToken(): Token
    {
        /** @var TokenEndpoint $endpoint */
        $endpoint = $this->container->get('auth');

        return $endpoint->getToken();
    }

    public function checkConnection(): bool
    {
        /** @var MainEndpoint $endpoint */
        $endpoint = $this->container->get('main');
        $endpoint->setToken($this->getToken());

        return $endpoint->isConnected();
    }

    public function getReferenceData(): ReferenceData
    {
        /** @var ReferenceDataEndpoint $endpoint */
        $endpoint = $this->container->get('referenceData');
        $endpoint->setToken($this->getToken());

        return $endpoint->getReferenceData();
    }

    /**
     * @inheritDoc
     */
    public function validateTranslationRequest(TranslationRequest $translationRequest): bool
    {
        /** @var ValidateEndpoint $endpoint */
        $endpoint = $this->container->get('validate');
        return $endpoint
            ->setToken($this->getToken())
            ->validateTranslationRequest($translationRequest);
    }

    public function sendTranslationRequest(TranslationRequest $translationRequest): string
    {
        /** @var RequestsEndpoint $endpoint */
        $endpoint = $this->container->get('requests');
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
        $endpoint = $this->container->get('identifier');
        $endpoint->setToken($this->getToken());

        return $endpoint->getPermanentIdentifier($correlationId);
    }

    /**
     * @inheritDoc
     */
    public function getRequestStatus(string $permanentId): TranslationResponse
    {
        /** @var StatusEndpoint $endpoint */
        $endpoint = $this->container->get('status');
        $endpoint->setToken($this->getToken());

        return $endpoint->getTranslationRequestStatus($permanentId);
    }

    public function downloadFile(string $url): string
    {
        /** @var Download $downloader */
        $downloader = $this->container->get('file');
        $downloader->setToken($this->getToken());

        return $downloader->downloadFile($url);
    }

    private function createContainer(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
    ): void {
        $container = new Container();

        $container->add('token_config', new LiteralArgument($this->extractConfigValues([
            'username',
            'password',
            'client',
        ])));

        // Endpoint services are not shared, meaning that a new instance is
        // created every time the service is requested from the container.
        // We're doing this because such a service might be called more than
        // once during the lifetime of a request, so internals set in a previous
        // usage may leak into the later usages.
        $container->add('rest', Rest::class)
            ->addArguments([
                $httpClient,
                $requestFactory,
                $streamFactory,
            ]);
        $container->add('main', MainEndpoint::class)
            ->addArgument('rest')
            ->addArgument(new LiteralArgument($this->getConfigValue('mainApiEndpoint')));
        $container->add('referenceData', ReferenceDataEndpoint::class)
            ->addArgument('rest')
            ->addArgument(new LiteralArgument($this->getConfigValue('referenceDataApiEndpoint')));
        $container->add('validate', ValidateEndpoint::class)
            ->addArgument('rest')
            ->addArgument(new LiteralArgument($this->getConfigValue('validateApiEndpoint')));
        $container->add('requests', RequestsEndpoint::class)
            ->addArgument('rest')
            ->addArgument(new LiteralArgument($this->getConfigValue('requestsApiEndpoint')));
        $container->add('identifier', IdentifierEndpoint::class)
            ->addArgument('rest')
            ->addArgument(new LiteralArgument($this->getConfigValue('identifierApiEndpoint')));
        $container->add('status', StatusEndpoint::class)
            ->addArgument('rest')
            ->addArgument(new LiteralArgument($this->getConfigValue('statusApiEndpoint')));
        $container->add('file', Download::class)
            ->addArgument('rest');
        $container->add('auth', TokenEndpoint::class)
            ->addArgument('rest')
            ->addArguments([
                new LiteralArgument($this->getConfigValue('tokenApiEndpoint')),
                'token_config',
            ]);

        // Keep a reference to the container.
        $this->container = $container;
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
