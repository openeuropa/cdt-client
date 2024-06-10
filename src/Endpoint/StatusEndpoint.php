<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
use OpenEuropa\CdtClient\Model\Response\Translation;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
 * Class StatusEndpoint
 *
 * Defines how the client should handle requests to the "requests/:requestyear/:requestnumber" space of the API.
 *
 * @see EndpointBase
 */
class StatusEndpoint extends EndpointBase
{
    use ValidationAwareTrait;

    public const ENDPOINT_URL_PATH = '/v2/requests/:requestyear/:requestnumber';

    public function getTranslationRequestStatus(string $permanentId): Translation
    {
        if (!preg_match('/^\d{4}\/[^\/]+$/', $permanentId)) {
            throw new \InvalidArgumentException('Invalid permanent ID format (it should be formatted like 2024/1234567).');
        }
        [$year, $id] = explode('/', $permanentId);

        $url = $this->getEndpointUrl([
            ':requestyear' => $year,
            ':requestnumber' => $id,
        ]);
        try {
            $response = $this->rest->get($url, $this->getAuthorizationHeaders($this->token));
        } catch (InvalidStatusCodeException $e) {
            throw $this->dispatchValidationException($e);
        }

        return $this->getSerializer()->deserialize(
            $response->getBody()->__toString(),
            Translation::class,
            'json'
        );
    }
}
