<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
 * Class IdentifierEndpoint
 *
 * Defines how the client should handle requests to the "requestIdentifierByCorrelationId" space of the API.
 * Implements the TokenAwareInterface to handle authentication tokens for secure communication.
 *
 * @see EndpointBase
 * @see TokenAwareInterface
 * @see ValidationAwareTrait
 */
class IdentifierEndpoint extends EndpointBase implements TokenAwareInterface
{
    use TokenAwareTrait;
    use ValidationAwareTrait;

    protected function getEndpointUrlPath(): string
    {
        return '/v2/requests/requestIdentifierByCorrelationId/:correlationId';
    }

    public function getPermanentIdentifier(string $correlationId): string
    {
        $url = $this->getEndpointUrl([':correlationId' => $correlationId]);
        try {
            $response = $this->rest->get($url, $this->getAuthorizationHeaders());
        } catch (InvalidStatusCodeException $e) {
            throw $this->dispatchValidationException($e);
        }

        return $response->getBody()->__toString();
    }
}
