<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use League\Container\Argument\LiteralArgument;
use League\Container\Container;
use OpenEuropa\CdtClient\Contract\ApiClientInterface;
use OpenEuropa\CdtClient\Contract\EndpointInterface;
use OpenEuropa\CdtClient\Endpoint\MainEndpoint;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Model\Token;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;
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
     * The configuration.
     *
     * @var array<string, mixed>
     */
    protected array $configuration = [];

    protected ContainerInterface $container;

    protected UriFactoryInterface $uriFactory;

    protected Token $token;

    /**
     * @param ClientInterface         $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface  $streamFactory
     * @param UriFactoryInterface     $uriFactory
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

    /**
     * @inheritDoc
     */
    public function requestToken(): Token
    {
        /** @var TokenEndpoint $endpoint */
        $endpoint = $this->container->get('auth');

        return $endpoint->execute();
    }

    /**
     * @inheritDoc
     */
    public function checkConnection(): bool
    {
        /** @var MainEndpoint $endpoint */
        $endpoint = $this->container->get('main');
        $endpoint->setToken($this->getToken());

        return $endpoint->execute();
    }

    /**
     * @param ClientInterface     $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface  $streamFactory
     * @param UriFactoryInterface     $uriFactory
     */
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
        $container->add('multipartStreamBuilder', MultipartStreamBuilder::class)
            ->addArgument($streamFactory);
        $container->add('main', MainEndpoint::class)
            ->addArgument(new LiteralArgument($this->getConfigValue('mainApiEndpoint')));
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
                'setMultipartStreamBuilder' => ['multipartStreamBuilder'],
                'setJsonEncoder' => [new JsonEncoder()],
            ]);

        // Keep a reference to the container.
        $this->container = $container;
    }

    /**
     * Extracts a subset of values from the client configuration.
     *
     * Non-existing and boolean keys are not returned.
     *
     * @param string[] $names
     *   A list of configuration keys to extract.
     * @return array<string, mixed>
     */
    private function extractConfigValues(array $names): array
    {
        return array_intersect_key(
            $this->configuration,
            array_flip($names)
        );
    }

    /**
     * Retrieves a value from the client configuration.
     *
     * @param string $name
     * @return mixed|null
     */
    private function getConfigValue(string $name)
    {
        return array_key_exists($name, $this->configuration) ? $this->configuration[$name] : null;
    }

    /**
     * @inheritDoc
     */
    public function setToken(Token $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getToken(): Token
    {
        return $this->token;
    }
}
