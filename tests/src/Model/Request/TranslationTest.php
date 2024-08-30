<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\CallbackCollection;
use OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection;
use OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection;
use OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection;
use OpenEuropa\CdtClient\Model\StringCollection;
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
            'contactUserNames' => ['TEST_USER'],
            'deliveryContactUsernames' => ['TEST_USER'],
            'phoneNumber' => '111111111',
            'title' => 'TEST_TITLE',
            'clientReference' => '2',
            'purposeCode' => 'TEST_PC',
            'deliveryModeCode' => 'TEST_DMC',
            'priorityCode' => 'TEST_SL',
            'comments' => 'TEST_COMMENTS',
            'sendOptions' => 'TEST_SO',
            'service' => 'TEST_SERVICE',
            'isQuotationOnly' => true,
        ];
        $translation = $this->createRequestTranslation($data);

        $this->assertEquals($data['departmentCode'], $translation->getDepartmentCode());
        $this->assertInstanceOf(StringCollection::class, $translation->getContactUserNames());
        $this->assertEquals($data['contactUserNames'], (array) $translation->getContactUserNames());
        $this->assertInstanceOf(StringCollection::class, $translation->getDeliveryContactUsernames());
        $this->assertEquals($data['deliveryContactUsernames'], (array) $translation->getDeliveryContactUsernames());
        $this->assertEquals($data['phoneNumber'], $translation->getPhoneNumber());
        $this->assertEquals($data['title'], $translation->getTitle());
        $this->assertEquals($data['clientReference'], $translation->getClientReference());
        $this->assertEquals($data['purposeCode'], $translation->getPurposeCode());
        $this->assertEquals($data['deliveryModeCode'], $translation->getDeliveryModeCode());
        $this->assertEquals($data['priorityCode'], $translation->getPriorityCode());
        $this->assertEquals($data['comments'], $translation->getComments());
        $this->assertInstanceOf(ReferenceUrlCollection::class, $translation->getReferenceSetUrls());
        $this->assertInstanceOf(ReferenceFileCollection::class, $translation->getReferenceSetFiles());
        $this->assertInstanceOf(SourceDocumentCollection::class, $translation->getSourceDocuments());
        $this->assertEquals($data['sendOptions'], $translation->getSendOptions());
        $this->assertEquals($data['service'], $translation->getService());
        $this->assertEquals($data['isQuotationOnly'], $translation->isQuotationOnly());
        $this->assertInstanceOf(CallbackCollection::class, $translation->getCallbacks());
    }
}
