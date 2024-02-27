<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\CallbackCollection;
use OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection;
use OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection;
use OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection;
use OpenEuropa\Tests\CdtClient\Traits\ModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\Translation
 */
class TranslationTest extends TestCase
{
    use ModelTestTrait;

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
