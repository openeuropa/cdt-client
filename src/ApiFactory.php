<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient;

use OpenEuropa\CdtClient\Endpoint\EndpointBase;
use OpenEuropa\CdtClient\Endpoint\IdentifierEndpoint;
use OpenEuropa\CdtClient\Endpoint\MainEndpoint;
use OpenEuropa\CdtClient\Endpoint\ReferenceDataEndpoint;
use OpenEuropa\CdtClient\Endpoint\RequestsEndpoint;
use OpenEuropa\CdtClient\Endpoint\StatusEndpoint;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Endpoint\ValidateEndpoint;
use OpenEuropa\CdtClient\Http\Download;
use OpenEuropa\CdtClient\Http\Rest;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Traits\ConfigurationAwareTrait;

/**
 * Class ApiFactory
 *
 * Creates the endpoints and "Download" objects.
 *
 * @see ApiClientInterface
 * @see ConfigurationAwareTrait
 */
class ApiFactory
{
    use ConfigurationAwareTrait;

    protected Token $token;

    /**
     * @param array<string, mixed> $configuration
     */
    public function __construct(protected Rest $rest, protected array $configuration)
    {
    }

    public function setToken(Token $token): ApiFactory
    {
        $this->token = $token;
        return $this;
    }

    public function createEndpoint(string $class): EndpointBase
    {
        switch ($class) {
            case TokenEndpoint::class:
                return new TokenEndpoint($this->rest, $this->extractConfigValues([
                    'username',
                    'password',
                    'client',
                    'apiBaseUrl',
                ]));
            case MainEndpoint::class:
            case ReferenceDataEndpoint::class:
            case ValidateEndpoint::class:
            case RequestsEndpoint::class:
            case IdentifierEndpoint::class:
            case StatusEndpoint::class:
                return new $class($this->rest, $this->extractConfigValues(['apiBaseUrl']), $this->token);
            default:
                throw new \InvalidArgumentException("Invalid endpoint class: '{$class}'.");
        }
    }

    public function createDownload(): Download
    {
        return new Download($this->rest, $this->token);
    }
}
