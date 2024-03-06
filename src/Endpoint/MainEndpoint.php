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

    public function execute(): bool
    {
        return $this->send('GET')->getBody()->__toString() === 'true';
    }
}
