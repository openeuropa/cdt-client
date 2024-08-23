<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection
 */
class ReferenceFileCollectionTest extends TestCase
{
    use RequestModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createRequestReferenceFile(['file' => $this->createRequestFile(['filename' => 'file1.txt'])]),
            $this->createRequestReferenceFile(['file' => $this->createRequestFile(['filename' => 'file2.txt'])]),
            $this->createRequestReferenceFile(['file' => $this->createRequestFile(['filename' => 'file3.txt'])]),
        ], ReferenceFileCollection::class);
    }
}
