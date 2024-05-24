<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
use OpenEuropa\CdtClient\Model\Request\Translation;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
 * Class RequestsEndpoint
 *
 * Defines how the client should handle requests to the "Requests" space of the API.
 * Implements the TokenAwareInterface to handle authentication tokens for secure communication.
 *
 * @see EndpointBase
 * @see TokenAwareInterface
 * @see ValidationAwareTrait
 */
class RequestsEndpoint extends EndpointBase implements TokenAwareInterface
{
    use TokenAwareTrait;
    use ValidationAwareTrait;

    const ENDPOINT_URL_PATH = '/v2/requests';

    public function sendTranslationRequest(Translation $translationRequest): string
    {
        $body = $this->getSerializer()->serialize($translationRequest, 'json');
        try {
            $response = $this->rest->postJson($this->getEndpointUrl(), $body, $this->getAuthorizationHeaders());
        } catch (InvalidStatusCodeException $e) {
            throw $this->dispatchValidationException($e);
        }
        return $response->getBody()->__toString();
    }
}
