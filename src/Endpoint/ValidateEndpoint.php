<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
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
 * @see ValidationAwareTrait
 */
class ValidateEndpoint extends EndpointBase implements TokenAwareInterface
{
    use TokenAwareTrait;
    use ValidationAwareTrait;

    protected function getEndpointUrlPath(): string
    {
        return '/v2/requests/validate';
    }

    public function validateTranslationRequest(Translation $translationRequest): bool
    {
        $body = $this->getSerializer()->serialize($translationRequest, 'json');
        try {
            $response = $this->rest->postJson($this->getEndpointUrl(), $body, $this->getAuthorizationHeaders());
        } catch (InvalidStatusCodeException $e) {
            throw $this->dispatchValidationException($e);
        }
        return $response->getBody()->__toString() === 'true';
    }
}
