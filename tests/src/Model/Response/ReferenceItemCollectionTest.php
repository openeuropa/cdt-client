<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection
 */
class ReferenceItemCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createResponseReferenceItem(['code' => 'CODE1']),
            $this->createResponseReferenceItem(['code' => 'CODE2']),
            $this->createResponseReferenceItem(['code' => 'CODE3']),
        ], ReferenceItemCollection::class);
    }
}
