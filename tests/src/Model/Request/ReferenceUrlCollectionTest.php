<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\ReferenceUrl;
use OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection;
use OpenEuropa\Tests\CdtClient\Traits\AssertCollectionTrait;
use OpenEuropa\Tests\CdtClient\Traits\ModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection
 */
class ReferenceUrlCollectionTest extends TestCase
{
    use ModelTestTrait;
    use AssertCollectionTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection
     */
    public function testCollection(): void
    {
        $items = [
            $this->createRequestReferenceUrl(),
            $this->createRequestReferenceUrl(),
        ];

        $extraItem = $this->createRequestReferenceUrl();
        $collection = new ReferenceUrlCollection($items);
        $this->assertCollection($collection, ReferenceUrl::class, $items, $extraItem);
    }
}
