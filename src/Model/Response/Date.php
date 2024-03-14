<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

/**
 * Class Date.
 *
 * Represents the single date object received from the CDT API.
 */
class Date
{
    protected string $label;

    /**
     * @var \DateTimeInterface
     */
    protected \DateTimeInterface $date;

    protected string $ecdtDateType;

    protected ?string $tooltip = null;

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getEcdtDateType(): string
    {
        return $this->ecdtDateType;
    }

    public function setEcdtDateType(string $ecdtDateType): self
    {
        $this->ecdtDateType = $ecdtDateType;
        return $this;
    }

    public function getTooltip(): ?string
    {
        return $this->tooltip;
    }

    public function setTooltip(?string $tooltip): self
    {
        $this->tooltip = $tooltip;
        return $this;
    }
}
