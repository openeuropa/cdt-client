<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

/**
 * Class ReferenceItem.
 *
 * Represents the single item of business reference data obtained from the CDT API.
 * Stores the code and description of the value.
 */
class ReferenceItem
{

    /**
     * The code of the value.
     */
    protected string $code;

    /**
     * The description of the value.
     */
    protected string $description;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
}
