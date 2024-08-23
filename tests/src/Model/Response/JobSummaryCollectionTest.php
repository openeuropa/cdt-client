<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\JobSummaryCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\JobSummaryCollection
 */
class JobSummaryCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Response\JobSummaryCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createResponseJobSummary(['fileName' => 'file1.pdf']),
            $this->createResponseJobSummary(['fileName' => 'file2.pdf']),
            $this->createResponseJobSummary(['fileName' => 'file3.pdf']),
        ], JobSummaryCollection::class);
    }
}
