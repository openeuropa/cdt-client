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

    public function getCallbackType(): string
    {
        return $this->callbackType;
    }

    public function setCallbackType(string $callbackType): self
    {
        $this->callbackType = $callbackType;
        return $this;
    }

    public function getCallbackBaseUrl(): string
    {
        return $this->callbackBaseUrl;
    }

    public function setCallbackBaseUrl(string $callbackBaseUrl): self
    {
        $this->callbackBaseUrl = $callbackBaseUrl;
        return $this;
    }

    public function getClientApiKey(): string
    {
        return $this->clientApiKey;
    }

    public function setClientApiKey(string $clientApiKey): self
    {
        $this->clientApiKey = $clientApiKey;
        return $this;
    }
}
