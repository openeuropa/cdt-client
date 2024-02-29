<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\ReferenceContact;
use OpenEuropa\CdtClient\Model\Response\ReferenceContactCollection;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestCollectionTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\ReferenceContactCollection
 */
class ReferenceContactCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use AssertTestCollectionTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\ReferenceContactCollection
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     */
    public function testCollection(): void
    {
        $items = [
            $this->createResponseReferenceContact([
                'userName' => 'U1',
            ]),
            $this->createResponseReferenceContact([
                'userName' => 'U2',
            ]),
        ];

        $collection = new ReferenceContactCollection($items);
        $this->assertCollection($collection, ReferenceContact::class, $items);
    }
}
