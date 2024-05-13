<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Http;

use OpenEuropa\CdtClient\Contract\RestInterface;
use OpenEuropa\CdtClient\Contract\TokenAwareInterface;
use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
use OpenEuropa\CdtClient\Traits\SerializerAwareTrait;
use OpenEuropa\CdtClient\Traits\TokenAwareTrait;
use OpenEuropa\CdtClient\Traits\ValidationAwareTrait;

/**
* A class that download files from the API.
 *
 * @see TokenAwareInterface
 * @see ValidationAwareTrait
 * @see SerializerAwareTrait
*/
class Download implements TokenAwareInterface
{
    use TokenAwareTrait;
    use ValidationAwareTrait;
    use SerializerAwareTrait;

    public function __construct(protected RestInterface $rest)
    {
    }

    public function downloadFile(string $uri): string
    {
        try {
            $response = $this->rest->get($uri, $this->getAuthorizationHeaders());
            return $response->getBody()->__toString();
        } catch (InvalidStatusCodeException $e) {
            throw $this->dispatchValidationException($e);
        }
    }
}
