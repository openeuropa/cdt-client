<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\ReferenceItem;
use OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestCollectionTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection
 */
class ReferenceItemCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use AssertTestCollectionTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     */
    public function testCollection(): void
    {
        $items = [
            $this->createResponseReferenceItem([
                'code' => 'IT1',
            ]),
            $this->createResponseReferenceItem([
                'code' => 'IT2',
            ]),
        ];

        $collection = new ReferenceItemCollection($items);
        $this->assertCollection($collection, ReferenceItem::class, $items);
    }
}
