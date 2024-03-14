<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Model\Response\Translation;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
 * Class StatusEndpoint
 *
 * Defines how the client should handle requests to the "requests/:requestyear/:requestnumber" space of the API.
 * Implements the TokenAwareInterface to handle authentication tokens for secure communication.
 *
 * @see EndpointBase
 * @see TokenAwareInterface
 */
class StatusEndpoint extends EndpointBase implements TokenAwareInterface
{
    use TokenAwareTrait;
    use ValidationAwareTrait;

    protected string $permanentId;

    public function getPermanentId(): string
    {
        return $this->permanentId;
    }

    public function setPermanentId(string $permanentId): self
    {
        if (!preg_match('/^\d{4}\/[^\/]+$/', $permanentId)) {
            throw new \InvalidArgumentException('Invalid permanent ID format (it should be formatted like 2024/1234567).');
        }

        $this->permanentId = $permanentId;
        return $this;
    }

    public function execute(): Translation
    {
        [$year, $id] = explode('/', $this->permanentId);

        /** @var Translation $translation */
        $translation = $this->getSerializer()->deserialize(
            $this->send('GET', [
                ':requestyear' => $year,
                ':requestnumber' => $id,
            ])->getBody()->__toString(),
            Translation::class,
            'json'
        );
        return $translation;
    }
}
