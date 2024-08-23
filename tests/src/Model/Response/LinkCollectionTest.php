<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\LinkCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\LinkCollection
 */
class LinkCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Response\LinkCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createResponseLink(['href' => 'http://example1.com']),
            $this->createResponseLink(['href' => 'http://example2.com']),
            $this->createResponseLink(['href' => 'http://example3.com']),
        ], LinkCollection::class);
    }
}
