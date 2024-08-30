<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\LinkCollection;
use OpenEuropa\CdtClient\Model\StringCollection;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\ReferenceFile
 */
class ReferenceFileTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\ReferenceFile
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'fileName' => 'test_file.xml',
            'isPrivate' => true,
            'languages' => ['PL', 'ES'],
        ];
        $referenceFile = $this->createResponseReferenceFile($data);

        $this->assertEquals($data['fileName'], $referenceFile->getFileName());
        $this->assertEquals($data['isPrivate'], $referenceFile->isPrivate());
        $this->assertInstanceOf(StringCollection::class, $referenceFile->getLanguages());
        $this->assertEquals($data['languages'], (array) $referenceFile->getLanguages());
        $this->assertInstanceOf(LinkCollection::class, $referenceFile->getLinks());
    }
}
