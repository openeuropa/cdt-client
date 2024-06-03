<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Contract;

use OpenEuropa\CdtClient\Endpoint\EndpointBase;
use OpenEuropa\CdtClient\Http\Download;
use OpenEuropa\CdtClient\Model\Response\Token;

interface ApiFactoryInterface
{
    public function setToken(Token $token): ApiFactoryInterface;

    public function createEndpoint(string $class): EndpointBase;

    public function createDownload(): Download;
}
