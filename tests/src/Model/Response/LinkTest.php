<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\Link
 */
class LinkTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\Link
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'href' => 'https://example.com/testurl',
            'method' => 'POST',
        ];
        $link = $this->createResponseLink($data);

        $this->assertEquals($data['href'], $link->getHref());
        $this->assertEquals($data['method'], $link->getMethod());
    }
}
