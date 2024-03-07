<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Model\Response\File;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
 * Class StatusEndpoint
 *
 * Defines how the client should handle requests to the "requests/:requestyear/:requestnumber/targets-base64" space of the API.
 * Implements the TokenAwareInterface to handle authentication tokens for secure communication.
 *
 * @see EndpointBase
 * @see TokenAwareInterface
 */
class FileEndpoint extends EndpointBase implements TokenAwareInterface
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

    /**
     * @return array<int, File>
     */
    public function execute(): array
    {
        [$year, $id] = explode('/', $this->permanentId);

        /** @var array<int, File> $fileList */
        $fileList = $this->getSerializer()->deserialize(
            $this->send('GET', [
                ':requestyear' => $year,
                ':requestnumber' => $id,
            ])->getBody()->__toString(),
            File::class . '[]',
            'json'
        );
        return $fileList;
    }
}
