<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\File;
use OpenEuropa\Tests\CdtClient\Traits\ModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\ReferenceFile
 */
class ReferenceFileTest extends TestCase
{
    use ModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\ReferenceFile
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'referenceLanguages' => ['fr'],
        ];
        $referenceFile = $this->createRequestReferenceFile($data);

        $this->assertEquals($data['referenceLanguages'], $referenceFile->getReferenceLanguages());
        $this->assertInstanceOf(File::class, $referenceFile->getFile());
    }
}
