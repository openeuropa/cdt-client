<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

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
            'referenceLanguages' => ['fr'],
            'url' => 'https://example.com',
            'shortName' => 'Example',
        ];
        $referenceFile = $this->createRequestReferenceUrl($data);

        $this->assertEquals($data['referenceLanguages'], $referenceFile->getReferenceLanguages());
        $this->assertEquals($data['url'], $referenceFile->getUrl());
        $this->assertEquals($data['shortName'], $referenceFile->getShortName());
    }
}
