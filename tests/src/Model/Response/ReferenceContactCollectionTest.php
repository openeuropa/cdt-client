<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\ReferenceContactCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\ReferenceContactCollection
 */
class ReferenceContactCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Response\ReferenceContactCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createResponseReferenceContact(['email' => 'user@example1.com']),
            $this->createResponseReferenceContact(['email' => 'user@example2.com']),
            $this->createResponseReferenceContact(['email' => 'user@example3.com']),
        ], ReferenceContactCollection::class);
    }
}
