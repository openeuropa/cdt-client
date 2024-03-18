<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Callback;

use OpenEuropa\Tests\CdtClient\Traits\CallbackModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Callback\RequestStatus
 */
class RequestStatusTest extends TestCase
{
    use CallbackModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Callback\RequestStatus
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'requestIdentifier' => 'TEST_ID',
            'status' => 'TEST_STATUS',
            'date' => new \DateTime('2023-12-31T23:59:59+00:00'),
            'correlationId' => '111',
        ];
        $requestStatus = $this->createCallbackRequestStatus($data);

        $this->assertEquals($data['requestIdentifier'], $requestStatus->getRequestIdentifier());
        $this->assertEquals($data['status'], $requestStatus->getStatus());
        $this->assertEquals($data['date'], $requestStatus->getDate());
        $this->assertEquals($data['correlationId'], $requestStatus->getCorrelationId());
    }
}
