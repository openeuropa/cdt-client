<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\Callback;
use OpenEuropa\CdtClient\Model\Request\CallbackCollection;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestCollectionTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\CallbackCollection
 */
class CallbackCollectionTest extends TestCase
{
    use RequestModelTestTrait;
    use AssertTestCollectionTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\CallbackCollection
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     */
    public function testCollection(): void
    {
        $items = [
            $this->createRequestCallback([
                'callbackBaseUrl' => 'https://example1.com',
            ]),
            $this->createRequestCallback([
                'callbackBaseUrl' => 'https://example2.com',
            ]),
        ];

        $collection = new CallbackCollection($items);
        $this->assertCollection($collection, Callback::class, $items);
    }
}
