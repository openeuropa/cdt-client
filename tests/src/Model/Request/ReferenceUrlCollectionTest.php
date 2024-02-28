<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\ReferenceUrl;
use OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestCollectionTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection
 */
class ReferenceUrlCollectionTest extends TestCase
{
    use RequestModelTestTrait;
    use AssertTestCollectionTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     */
    public function testCollection(): void
    {
        $items = [
            $this->createRequestReferenceUrl([
                'url' => 'https://example1.com',
            ]),
            $this->createRequestReferenceUrl([
                'url' => 'https://example2.com',
            ]),
        ];

        $collection = new ReferenceUrlCollection($items);
        $this->assertCollection($collection, ReferenceUrl::class, $items);
    }
}
