<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\ReferenceFileCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\ReferenceFileCollection
 */
class ReferenceFileCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Response\ReferenceFileCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createResponseReferenceFile(['fileName' => 'file1.pdf']),
            $this->createResponseReferenceFile(['fileName' => 'file2.pdf']),
            $this->createResponseReferenceFile(['fileName' => 'file3.pdf']),
        ], ReferenceFileCollection::class);
    }
}
