<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
 * Class FileEndpoint
 *
 * Defines how the client should handle requests to download files from the API.
 * Implements the TokenAwareInterface to handle authentication tokens for secure communication.
 *
 * @see EndpointBase
 * @see TokenAwareInterface
 */
class FileEndpoint extends EndpointBase implements TokenAwareInterface
{
    use TokenAwareTrait;
    use ValidationAwareTrait;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        // Disable the parent constructor. The configuration is handled by setFileUrl().
    }

    public function getFileUrl(): string
    {
        return $this->configuration['endpointUrl'];
    }

    public function setFileUrl(string $fileUrl): self
    {
        $configuration['endpointUrl'] = $fileUrl;
        $this->configuration = $this->getConfigurationResolver()->resolve($configuration);
        return $this;
    }

    public function execute(): string
    {
        return $this->send('GET')->getBody()->__toString();
    }
}
