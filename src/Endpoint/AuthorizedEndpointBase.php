<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Endpoint;

use OpenEuropa\CdtClient\Contract\RestInterface;
use OpenEuropa\CdtClient\Model\Response\Token;

/**
 * Class AuthorizedEndpointBase
 *
 * Serves as the base for endpoint classes with token support.
 */
abstract class AuthorizedEndpointBase extends EndpointBase
{
    /**
     * @inheritDoc
     */
    public function __construct(protected RestInterface $rest, array $configuration, protected Token $token)
    {
        parent::__construct($rest, $configuration);
    }
}
