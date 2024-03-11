<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\Callback
 */
class CallbackTest extends TestCase
{
    use RequestModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\Callback
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'callbackType' => 'TEST_TYPE',
            'callbackBaseUrl' => 'https://example.com/test-url',
            'clientApiKey' => 'TEST_APIKEY'
        ];
        $callback = $this->createRequestCallback($data);

        $this->assertEquals($data['callbackType'], $callback->getCallbackType());
        $this->assertEquals($data['callbackBaseUrl'], $callback->getCallbackBaseUrl());
        $this->assertEquals($data['clientApiKey'], $callback->getClientApiKey());
    }
}
