<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\CommentCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\CommentCollection
 */
class CommentCollectionTest extends TestCase
{
    use ResponseModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Response\CommentCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createResponseComment(['comment' => 'COMMENT 1']),
            $this->createResponseComment(['comment' => 'COMMENT 2']),
            $this->createResponseComment(['comment' => 'COMMENT 3']),
        ], CommentCollection::class);
    }
}
