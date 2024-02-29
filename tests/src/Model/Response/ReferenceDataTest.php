<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\ReferenceContactCollection;
use OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\ReferenceData
 */
class ReferenceDataTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\ReferenceData
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'languages' => ['EN'],
        ];
        $referenceItem = $this->createResponseReferenceData($data);

        $this->assertEquals($data['languages'], $referenceItem->getLanguages());
        $this->assertInstanceOf(ReferenceItemCollection::class, $referenceItem->getDepartments());
        $this->assertInstanceOf(ReferenceItemCollection::class, $referenceItem->getPriorities());
        $this->assertInstanceOf(ReferenceItemCollection::class, $referenceItem->getPurposes());
        $this->assertInstanceOf(ReferenceItemCollection::class, $referenceItem->getDeliveryModes());
        $this->assertInstanceOf(ReferenceItemCollection::class, $referenceItem->getConfidentialities());
        $this->assertInstanceOf(ReferenceItemCollection::class, $referenceItem->getStatuses());
        $this->assertInstanceOf(ReferenceItemCollection::class, $referenceItem->getServices());
        $this->assertInstanceOf(ReferenceItemCollection::class, $referenceItem->getSendOptions());
        $this->assertInstanceOf(ReferenceContactCollection::class, $referenceItem->getContacts());
    }
}
