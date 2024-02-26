<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

/**
 * Class ReferenceUrl.
 *
 * Represents the reference URL sent to the CDT API.
 */
class ReferenceUrl
{
    /**
     * The URL.
     */
    protected string $url;

    /**
     * The short name.
     */
    protected string $shortName;

    /**
     * The reference languages.
     *
     * @var string[]
     */
    protected array $referenceLanguages;
}
