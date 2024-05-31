<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
 * Class IdentifierEndpoint
 *
 * Defines how the client should handle requests to the "requestIdentifierByCorrelationId" space of the API.
 * Implements the ValidationAwareTrait to handle validation errors.
 *
 * @see AuthorizedEndpointBase
 * @see ValidationAwareTrait
 */
class IdentifierEndpoint extends AuthorizedEndpointBase
{
    use ValidationAwareTrait;

    const ENDPOINT_URL_PATH = '/v2/requests/requestIdentifierByCorrelationId/:correlationId';

    public function getPermanentIdentifier(string $correlationId): string
    {
        $url = $this->getEndpointUrl([':correlationId' => $correlationId]);
        try {
            $response = $this->rest->get($url, $this->token->getAuthorizationHeaders());
        } catch (InvalidStatusCodeException $e) {
            throw $this->dispatchValidationException($e);
        }

        return $response->getBody()->__toString();
    }
}
