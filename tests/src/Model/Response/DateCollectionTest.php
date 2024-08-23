<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\DateCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\DateCollection
 */
class DateCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Response\DateCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createResponseDate(['date' => new \DateTimeImmutable('2024-03-07T16:00:00+01:00')]),
            $this->createResponseDate(['date' => new \DateTimeImmutable('2024-03-08T16:00:00+01:00')]),
            $this->createResponseDate(['date' => new \DateTimeImmutable('2024-03-09T16:00:00+01:00')]),
        ], DateCollection::class);
    }
}
