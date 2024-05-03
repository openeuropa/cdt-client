<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
use OpenEuropa\CdtClient\Model\Response\File;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
 * Class FileEndpoint
 *
 * Defines how the client should handle requests to the "requests/:requestyear/:requestnumber/targets-base64" space of the API.
 * Implements the TokenAwareInterface to handle authentication tokens for secure communication.
 *
 * @see EndpointBase
 * @see TokenAwareInterface
 * @see ValidationAwareTrait
 */
class FileEndpoint extends EndpointBase implements TokenAwareInterface
{
    use TokenAwareTrait;
    use ValidationAwareTrait;

    /**
     * @return array<int, File>
     */
    public function getTranslatedFiles(string $permanentId): array
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
            $response = $this->rest->get($url, $this->getAuthorizationHeaders());
        } catch (InvalidStatusCodeException $e) {
            throw $this->dispatchValidationException($e);
        }
        /** @var array<int, File> $fileList */
        $fileList = $this->getSerializer()->deserialize(
            $response->getBody()->__toString(),
            File::class . '[]',
            'json'
        );
        return $fileList;
    }
}
