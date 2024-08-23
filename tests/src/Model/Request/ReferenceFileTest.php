<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\File;
use OpenEuropa\CdtClient\Model\StringCollection;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\ReferenceFile
 */
class ReferenceFileTest extends TestCase
{
    use RequestModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\ReferenceFile
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'referenceLanguages' => ['FR'],
        ];
        $referenceFile = $this->createRequestReferenceFile($data);

        $this->assertInstanceOf(StringCollection::class, $referenceFile->getReferenceLanguages());
        $this->assertEquals($data['referenceLanguages'], (array) $referenceFile->getReferenceLanguages());
        $this->assertInstanceOf(File::class, $referenceFile->getFile());
    }
}
