<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection
 */
class ReferenceUrlCollectionTest extends TestCase
{
    use RequestModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createRequestReferenceUrl(['url' => 'https://example1.com']),
            $this->createRequestReferenceUrl(['url' => 'https://example2.com']),
            $this->createRequestReferenceUrl(['url' => 'https://example3.com']),
        ], ReferenceUrlCollection::class);
    }
}
