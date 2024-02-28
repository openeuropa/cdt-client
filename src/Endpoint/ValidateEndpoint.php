<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Model\Request\Translation;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
 * Class ValidateEndpoint
 *
 * Defines how the client should handle requests to the "Validate" space of the API.
 * Implements the TokenAwareInterface to handle authentication tokens for secure communication.
 *
 * @see EndpointBase
 * @see TokenAwareInterface
 */
class ValidateEndpoint extends EndpointBase implements TokenAwareInterface
{
    use TokenAwareTrait;
    use ValidationAwareTrait;

    protected Translation $translationRequest;

    public function getTranslationRequest(): Translation
    {
        return $this->translationRequest;
    }

    public function setTranslationRequest(Translation $translationRequest): self
    {
        $this->translationRequest = $translationRequest;
        return $this;
    }

    protected function getRequestJsonBody(): string
    {
        return $this->getSerializer()->serialize($this->getTranslationRequest(), 'json');
    }

    public function execute(): bool
    {
        return $this->send('POST')->getBody()->__toString() === 'true';
    }
}
