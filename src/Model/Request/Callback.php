<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

/**
 * Class Callback.
 *
 * Represents the callback sent to the CDT API.
 */
class Callback
{
    /**
     * The callback type.
     */
    protected string $callbackType;

    /**
     * The callback base url.
     */
    protected string $callbackBaseUrl;

    /**
     * The client api key.
     */
    protected string $clientApiKey;
}
