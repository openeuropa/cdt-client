<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;

/**
 * Class BusinessReferenceDataEndpoint
 *
 * Defines how the client should handle requests to the "Requests/ReferenceData" space of the API.
 * Implements the TokenAwareInterface to handle authentication tokens for secure communication.
 *
 * @see EndpointBase
 * @see TokenAwareInterface
 */
class BusinessReferenceDataEndpoint extends EndpointBase implements TokenAwareInterface
{
    use TokenAwareTrait;

    /**
     * @inheritDoc
     */
    public function execute(): ReferenceData
    {
        /** @var ReferenceData $referenceData */
        $referenceData = $this->getSerializer()->deserialize(
            $this->send('GET')->getBody()->__toString(),
            ReferenceData::class,
            'json'
        );
        return $referenceData;
    }
}
