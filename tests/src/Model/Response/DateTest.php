<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\Date
 */
class DateTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\Date
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'date' => new \DateTime('2024-02-07T16:00:00+01:00'),
            'label' => 'Date and time',
            'ecdtDateType' => 'LastDeadline',
            'tooltip' => 'The Tooltip',
        ];
        $date = $this->createResponseDate($data);

        $this->assertEquals($data['date'], $date->getDate());
        $this->assertEquals($data['label'], $date->getLabel());
        $this->assertEquals($data['ecdtDateType'], $date->getEcdtDateType());
        $this->assertEquals($data['tooltip'], $date->getTooltip());
    }
}
