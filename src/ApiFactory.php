<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient;

use OpenEuropa\CdtClient\Contract\ApiFactoryInterface;
use OpenEuropa\CdtClient\Contract\RestInterface;
use OpenEuropa\CdtClient\Endpoint\EndpointBase;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Http\Download;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Traits\ConfigurationAwareTrait;

/**
 * Class ApiFactory
 *
 * Provides a factory for creating API endpoints.
 *
 * @see ApiClientInterface
 */
class ApiFactory implements ApiFactoryInterface
{
    use ConfigurationAwareTrait;

    protected ?Token $token = null;

    /**
     * @param array<int|string, mixed> $configuration
     */
    public function __construct(protected RestInterface $rest, protected array $configuration)
    {
    }

    public function setToken(Token $token): ApiFactoryInterface
    {
        $this->token = $token;
        return $this;
    }

    public function createTokenEndpoint(): TokenEndpoint
    {
        return new TokenEndpoint($this->rest, $this->extractConfigValues([
            'username',
            'password',
            'client',
            'apiBaseUrl',
        ]));
    }

    public function createEndpoint(string $class): EndpointBase
    {
        if ($class === TokenEndpoint::class) {
            throw new \InvalidArgumentException("Token endpoints should be created using 'createTokenEndpoint' method.");
        }

        if (!is_subclass_of($class, EndpointBase::class)) {
            throw new \InvalidArgumentException("Invalid endpoint class: '$class'.");
        }

        return new $class($this->rest, $this->extractConfigValues(['apiBaseUrl']), $this->token);
    }

    public function createDownload(): Download
    {
        return new Download($this->rest, $this->token);
    }
}
