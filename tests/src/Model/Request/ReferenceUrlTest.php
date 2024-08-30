<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\StringCollection;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\ReferenceUrl
 */
class ReferenceUrlTest extends TestCase
{
    use RequestModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\ReferenceUrl
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'referenceLanguages' => ['FR'],
            'url' => 'https://example.com/testurl',
            'shortName' => 'TEST_SN',
        ];
        $referenceUrl = $this->createRequestReferenceUrl($data);

        $this->assertInstanceOf(StringCollection::class, $referenceUrl->getReferenceLanguages());
        $this->assertEquals($data['referenceLanguages'], (array) $referenceUrl->getReferenceLanguages());
        $this->assertEquals($data['url'], $referenceUrl->getUrl());
        $this->assertEquals($data['shortName'], $referenceUrl->getShortName());
    }
}
