<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
use OpenEuropa\CdtClient\Model\Request\Translation;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
 * Class ValidateEndpoint
 *
 * Defines how the client should handle requests to the "Validate" space of the API.
 * Implements the ValidationAwareInterface to handle validation errors.
 *
 * @see EndpointBase
 * @see ValidationAwareTrait
 */
class ValidateEndpoint extends EndpointBase
{
    use ValidationAwareTrait;

    const ENDPOINT_URL_PATH = '/v2/requests/validate';

    public function validateTranslationRequest(Translation $translationRequest): bool
    {
        $body = $this->getSerializer()->serialize($translationRequest, 'json');
        try {
            $response = $this->rest->postJson($this->getEndpointUrl(), $body, $this->getAuthorizationHeaders($this->token));
        } catch (InvalidStatusCodeException $e) {
            throw $this->dispatchValidationException($e);
        }
        return $response->getBody()->__toString() === 'true';
    }
}
