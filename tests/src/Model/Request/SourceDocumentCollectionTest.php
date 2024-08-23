<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection
 */
class SourceDocumentCollectionTest extends TestCase
{
    use RequestModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createRequestSourceDocument(['file' => $this->createRequestFile(['filename' => 'file1.txt'])]),
            $this->createRequestSourceDocument(['file' => $this->createRequestFile(['filename' => 'file2.txt'])]),
            $this->createRequestSourceDocument(['file' => $this->createRequestFile(['filename' => 'file3.txt'])]),
        ], SourceDocumentCollection::class);
    }
}
