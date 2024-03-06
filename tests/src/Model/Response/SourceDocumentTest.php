<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\SourceDocument
 */
class SourceDocumentTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\SourceDocument
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'fileName' => 'test.xml',
            'isPrivate' => false,
        ];
        $sourceDocument = $this->createResponseSourceDocument($data);

        $this->assertEquals($data['fileName'], $sourceDocument->getFileName());
        $this->assertEquals($data['isPrivate'], $sourceDocument->isPrivate());
    }
}
