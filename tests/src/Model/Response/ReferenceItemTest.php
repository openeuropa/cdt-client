<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\ReferenceItem
 */
class ReferenceItemTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\ReferenceItem
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'code' => 'TEST_CODE',
            'description' => 'TEST_DESCRIPTION',
        ];
        $referenceItem = $this->createResponseReferenceItem($data);

        $this->assertEquals($data['code'], $referenceItem->getCode());
        $this->assertEquals($data['description'], $referenceItem->getDescription());
    }
}
