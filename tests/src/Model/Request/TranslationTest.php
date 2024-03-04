<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\Translation
 */
class TranslationTest extends TestCase
{
    use RequestModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\Translation
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'departmentCode' => '123',
            'contactUserNames' => ['TESTUSER'],
            'deliveryContactUsernames' => ['TESTUSER'],
            'phoneNumber' => '123456789',
            'title' => 'Test Title',
            'clientReference' => '1',
            'purposeCode' => 'PC',
            'deliveryModeCode' => 'DMC',
            'priorityCode' => 'SL',
            'comments' => 'Test Comments',
            'sendOptions' => 'Send',
            'service' => 'Translation',
            'isQuotationOnly' => false
        ];
        $translation = $this->createRequestTranslation($data);

        $this->assertEquals($data['departmentCode'], $translation->getDepartmentCode());
        $this->assertEquals($data['contactUserNames'], $translation->getContactUserNames());
        $this->assertEquals($data['deliveryContactUsernames'], $translation->getDeliveryContactUsernames());
        $this->assertEquals($data['phoneNumber'], $translation->getPhoneNumber());
        $this->assertEquals($data['title'], $translation->getTitle());
        $this->assertEquals($data['clientReference'], $translation->getClientReference());
        $this->assertEquals($data['purposeCode'], $translation->getPurposeCode());
        $this->assertEquals($data['deliveryModeCode'], $translation->getDeliveryModeCode());
        $this->assertEquals($data['priorityCode'], $translation->getPriorityCode());
        $this->assertEquals($data['comments'], $translation->getComments());
        $this->assertIsArray($translation->getReferenceSetUrls());
        $this->assertIsArray($translation->getReferenceSetFiles());
        $this->assertIsArray($translation->getSourceDocuments());
        $this->assertEquals($data['sendOptions'], $translation->getSendOptions());
        $this->assertEquals($data['service'], $translation->getService());
        $this->assertEquals($data['isQuotationOnly'], $translation->isQuotationOnly());
        $this->assertIsArray($translation->getCallbacks());
    }
}
