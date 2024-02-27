<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\ReferenceFile;
use OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection;
use OpenEuropa\Tests\CdtClient\Traits\AssertCollectionTrait;
use OpenEuropa\Tests\CdtClient\Traits\ModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection
 */
class ReferenceFileCollectionTest extends TestCase
{
    use ModelTestTrait;
    use AssertCollectionTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection
     */
    public function testCollection(): void
    {
        $items = [
            $this->createRequestReferenceFile([
                'file' => $this->createRequestFile([
                    'filename' => 'test1.txt',
                ]),
            ]),
            $this->createRequestReferenceFile([
                'file' => $this->createRequestFile([
                    'filename' => 'test2.txt',
                ]),
            ])
        ];

        $extraItem = $this->createRequestReferenceFile();

        $collection = new ReferenceFileCollection($items);
        $this->assertCollection($collection, ReferenceFile::class, $items, $extraItem);
    }
}
