<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;

class MainEndpoint extends EndpointBase implements TokenAwareInterface
{
    use TokenAwareTrait;

    /**
     * @inheritDoc
     */
    public function execute(): bool
    {
        return $this->send('GET')->getBody()->__toString() === 'true';
    }
}
