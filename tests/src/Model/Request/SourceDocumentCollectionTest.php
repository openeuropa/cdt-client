<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\SourceDocument;
use OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestCollectionTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection
 */
class SourceDocumentCollectionTest extends TestCase
{
    use RequestModelTestTrait;
    use AssertTestCollectionTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     */
    public function testCollection(): void
    {
        $items = [
            $this->createRequestSourceDocument([
                'sourceLanguages' => ['fr'],
            ]),
            $this->createRequestSourceDocument([
                'sourceLanguages' => ['es'],
            ]),
        ];

        $collection = new SourceDocumentCollection($items);
        $this->assertCollection($collection, SourceDocument::class, $items);
    }
}
