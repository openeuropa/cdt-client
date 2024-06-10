<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Model\Response\ReferenceData;

/**
 * Class ReferenceDataEndpoint
 *
 * Defines how the client should handle requests to the "Requests/ReferenceData" space of the API.
 *
 * @see EndpointBase
 */
class ReferenceDataEndpoint extends EndpointBase
{
    public const ENDPOINT_URL_PATH = '/v2/requests/businessReferenceData';

    public function getReferenceData(): ReferenceData
    {
        $response = $this->rest->get($this->getEndpointUrl(), $this->getAuthorizationHeaders($this->token));
        return $this->getSerializer()->deserialize(
            $response->getBody()->__toString(),
            ReferenceData::class,
            'json'
        );
    }
}
