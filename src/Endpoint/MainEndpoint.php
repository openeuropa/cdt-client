<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

/**
 * Class MainEndpoint
 *
 * Defines how the client should handle requests to the "Main" space of the API.
 *
 * @see AuthorizedEndpointBase
 */
class MainEndpoint extends AuthorizedEndpointBase
{
    const ENDPOINT_URL_PATH = '/v2/CheckConnection';

    public function isConnected(): bool
    {
        $response = $this->rest->get($this->getEndpointUrl(), $this->token->getAuthorizationHeaders());
        return $response->getBody()->__toString() === 'true';
    }
}
