<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

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
        $this->assertIsArray($referenceItem->getDepartments());
        $this->assertIsArray($referenceItem->getPriorities());
        $this->assertIsArray($referenceItem->getPurposes());
        $this->assertIsArray($referenceItem->getDeliveryModes());
        $this->assertIsArray($referenceItem->getConfidentialities());
        $this->assertIsArray($referenceItem->getStatuses());
        $this->assertIsArray($referenceItem->getServices());
        $this->assertIsArray($referenceItem->getSendOptions());
        $this->assertIsArray($referenceItem->getContacts());
    }
}
