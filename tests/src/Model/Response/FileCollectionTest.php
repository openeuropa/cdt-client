<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\FileCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\FileCollection
 */
class FileCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Response\FileCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createResponseFile(['fileName' => 'file1.pdf']),
            $this->createResponseFile(['fileName' => 'file2.pdf']),
            $this->createResponseFile(['fileName' => 'file3.pdf']),
        ], FileCollection::class);
    }
}
