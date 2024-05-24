<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;

/**
 * Class MainEndpoint
 *
 * Defines how the client should handle requests to the "Main" space of the API. Implements the TokenAwareInterface to
 * handle authentication tokens for secure communication.
 *
 * @see EndpointBase
 * @see TokenAwareInterface
 */
class MainEndpoint extends EndpointBase implements TokenAwareInterface
{
    use TokenAwareTrait;

    const ENDPOINT_URL_PATH = '/v2/CheckConnection';

    public function isConnected(): bool
    {
        $response = $this->rest->get($this->getEndpointUrl(), $this->getAuthorizationHeaders());
        return $response->getBody()->__toString() === 'true';
    }
}
