<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Class Link.
 *
 * Represents the single link received from the CDT API.
 */
class Link
{
    /**
     * The URL.
     */
    #[SerializedName('Href')]
    protected string $href;

    /**
     * The method.
     */
    #[SerializedName('Method')]
    protected string $method;
}
