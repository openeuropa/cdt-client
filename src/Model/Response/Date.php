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
    /**
     * The label.
     */
    protected string $label;

    /**
     * The date.
     */
    protected \DateTimeInterface $date;

    /**
     * The ecdtDateType.
     */
    protected string $ecdtDateType;

    /**
     * The tooltip.
     */
    protected string $tooltip;
}
