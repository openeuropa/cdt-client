<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\SourceDocumentCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\SourceDocumentCollection
 */
class SourceDocumentCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Response\SourceDocumentCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createResponseSourceDocument(['fileName' => 'file1.pdf']),
            $this->createResponseSourceDocument(['fileName' => 'file2.pdf']),
            $this->createResponseSourceDocument(['fileName' => 'file3.pdf']),
        ], SourceDocumentCollection::class);
    }
}
