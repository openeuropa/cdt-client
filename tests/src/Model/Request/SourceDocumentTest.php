<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\File;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\SourceDocument
 */
class SourceDocumentTest extends TestCase
{
    use RequestModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\SourceDocument
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'sourceLanguages' => ['ES'],
            'outputDocumentFormatCode' => 'TEST_DFC',
            'confidentialityCode' => 'TEST_CC',
            'isPrivate' => true,
        ];
        $sourceDocument = $this->createRequestSourceDocument($data);

        $this->assertEquals($data['sourceLanguages'], $sourceDocument->getSourceLanguages());
        $this->assertEquals($data['outputDocumentFormatCode'], $sourceDocument->getOutputDocumentFormatCode());
        $this->assertEquals($data['confidentialityCode'], $sourceDocument->getConfidentialityCode());
        $this->assertEquals($data['isPrivate'], $sourceDocument->isPrivate());
        $this->assertInstanceOf(File::class, $sourceDocument->getFile());
        $this->assertIsArray($sourceDocument->getTranslationJobs());
    }
}
