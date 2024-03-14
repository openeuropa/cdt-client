<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\Comment
 */
class CommentTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\Comment
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'comment' => 'This is a comment content',
            'isHTML' => true,
            'from' => 'Joe Smith',
        ];
        $comment = $this->createResponseComment($data);

        $this->assertEquals($data['comment'], $comment->getComment());
        $this->assertEquals($data['isHTML'], $comment->isHTML());
        $this->assertEquals($data['from'], $comment->getFrom());
    }
}
