<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient;

use League\Container\Argument\LiteralArgument;
use League\Container\Container;
use OpenEuropa\CdtClient\Contract\ApiClientInterface;
use OpenEuropa\CdtClient\Contract\EndpointInterface;
use OpenEuropa\CdtClient\Endpoint\IdentifierEndpoint;
use OpenEuropa\CdtClient\Endpoint\MainEndpoint;
use OpenEuropa\CdtClient\Endpoint\ReferenceDataEndpoint;
use OpenEuropa\CdtClient\Endpoint\RequestsEndpoint;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Endpoint\ValidateEndpoint;
use OpenEuropa\CdtClient\Model\Request\Translation;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Model\Token;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Class ApiClient
 *
 * Provides a centralized client for interacting with the CDT API.
 * It handles requesting and setting up what is necessary to execute calls to the endpoints.
 *
 * @see ApiClientInterface
 * @see TokenAwareTrait
 */
class ApiClient implements ApiClientInterface
{
    /**
     * @var array<string, mixed>
     */
    protected array $configuration = [];

    protected ContainerInterface $container;

    protected UriFactoryInterface $uriFactory;

    protected Token $token;

    /**
     * @param array<string, mixed>    $configuration
     */
    public function __construct(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        UriFactoryInterface $uriFactory,
        array $configuration
    ) {
        $this->uriFactory = $uriFactory;
        $this->configuration = $configuration;
        $this->createContainer(
            $httpClient,
            $requestFactory,
            $streamFactory,
            $uriFactory,
        );
    }

    public function requestToken(): Token
    {
        /** @var TokenEndpoint $endpoint */
        $endpoint = $this->container->get('auth');

        return $endpoint->execute();
    }

    public function checkConnection(): bool
    {
        /** @var MainEndpoint $endpoint */
        $endpoint = $this->container->get('main');
        $endpoint->setToken($this->getToken());

        return $endpoint->execute();
    }

    public function getReferenceData(): ReferenceData
    {
        /** @var ReferenceDataEndpoint $endpoint */
        $endpoint = $this->container->get('referenceData');
        $endpoint->setToken($this->getToken());

        return $endpoint->execute();
    }

    /**
     * @inheritDoc
     */
    public function validateTranslationRequest(Translation $translationRequest): bool
    {
        /** @var ValidateEndpoint $endpoint */
        $endpoint = $this->container->get('validate');
        return $endpoint
            ->setToken($this->getToken())
            ->setTranslationRequest($translationRequest)
            ->execute();
    }

    public function sendTranslationRequest(Translation $translationRequest): string
    {
        /** @var RequestsEndpoint $endpoint */
        $endpoint = $this->container->get('requests');
        return $endpoint
            ->setToken($this->getToken())
            ->setTranslationRequest($translationRequest)
            ->execute();
    }

    /**
     * @inheritDoc
     */
    public function getPermanentIdentifier(string $correlationId): string
    {
        /** @var IdentifierEndpoint $endpoint */
        $endpoint = $this->container->get('identifier');
        $endpoint->setToken($this->getToken());
        $endpoint->setCorrelationId($correlationId);

        return $endpoint->execute();
    }

    private function createContainer(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        UriFactoryInterface $uriFactory
    ): void {
        $container = new Container();

        $container->add('token_config', new LiteralArgument($this->extractConfigValues([
            'username',
            'password',
            'client',
        ])));

        // All services are not shared, meaning that a new instance is
        // created every time the service is requested from the container.
        // We're doing this because such a service might be called more than
        // once during the lifetime of a request, so internals set in a previous
        // usage may leak into the later usages.
        $container->add('main', MainEndpoint::class)
            ->addArgument(new LiteralArgument($this->getConfigValue('mainApiEndpoint')));
        $container->add('referenceData', ReferenceDataEndpoint::class)
            ->addArgument(new LiteralArgument($this->getConfigValue('referenceDataApiEndpoint')));
        $container->add('validate', ValidateEndpoint::class)
            ->addArgument(new LiteralArgument($this->getConfigValue('validateApiEndpoint')));
        $container->add('requests', RequestsEndpoint::class)
            ->addArgument(new LiteralArgument($this->getConfigValue('requestsApiEndpoint')));
        $container->add('identifier', IdentifierEndpoint::class)
            ->addArgument(new LiteralArgument($this->getConfigValue('identifierApiEndpoint')));
        $container->add('auth', TokenEndpoint::class)
            ->addArguments([
                new LiteralArgument($this->getConfigValue('tokenApiEndpoint')),
                'token_config',
            ]);

        // Inject the services into endpoints.
        $container->inflector(EndpointInterface::class)
            ->invokeMethods([
                'setHttpClient' => [$httpClient],
                'setRequestFactory' => [$requestFactory],
                'setStreamFactory' => [$streamFactory],
                'setUriFactory' => [$uriFactory],
                'setJsonEncoder' => [new JsonEncoder()],
            ]);

        // Keep a reference to the container.
        $this->container = $container;
    }

    /**
     * Extracts a subset of values from the client configuration.
     *
     * Non-existing keys are not returned.
     *
     * @param string[] $names
     *   A list of configuration keys to extract.
     * @return array<string, mixed>
     */
    private function extractConfigValues(array $names): array
    {
        $config = [];

        foreach ($names as $name) {
            // We do not use self::getConfigValue() as we need to prevent
            // adding NULL for non-existing values.
            if (array_key_exists($name, $this->configuration)) {
                $config[$name] = $this->configuration[$name];
            }
        }

        return $config;
    }

    /**
     * Retrieves a value from the client configuration.
     */
    private function getConfigValue(string $name): mixed
    {
        return array_key_exists($name, $this->configuration) ? $this->configuration[$name] : null;
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
