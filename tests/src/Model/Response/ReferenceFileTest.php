<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

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
        $this->assertEquals($data['languages'], $referenceFile->getLanguages());
        $this->assertIsArray($referenceFile->getLinks());
    }
}
