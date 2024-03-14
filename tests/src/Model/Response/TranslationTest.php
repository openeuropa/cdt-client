<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\Translation
 */
class TranslationTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\Translation
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'requestIdentifier' => '111',
            'status' => 'TEST_STATUS',
            'sourceLanguages' => ['PL', 'ES'],
            'targetLanguages' => ['FR', 'NL'],
            'creationDate' => new \DateTime('2023-02-28T12:03:03.6239422'),
            'deliveryDate' => new \DateTime('2023-03-07T16:00:00+01:00'),
            'title' => 'TEST_TITLE',
            'service' => 'TEST_SERVICE',
            'department' => 'TEST_DEPARTMENT',
            'contacts' => ['TEST_CONTACT'],
            'deliverToContacts' => ['TEST_CONTACT_2'],
            'totalPrice' => 24.5,
            'isInProgress' => true,
            'clientReference' => '222',
            'deliveryModeCode' => 'TEST_DMC',
            'departmentCode' => 'TEST_DC',
            'phoneNumber' => '111111111',
            'purposeCode' => 'TEST_PC',
            'isQuotationOnly' => true,
        ];
        $translation = $this->createResponseTranslation($data);

        $this->assertEquals($data['requestIdentifier'], $translation->getRequestIdentifier());
        $this->assertEquals($data['status'], $translation->getStatus());
        $this->assertEquals($data['sourceLanguages'], $translation->getSourceLanguages());
        $this->assertEquals($data['targetLanguages'], $translation->getTargetLanguages());
        $this->assertEquals($data['creationDate'], $translation->getCreationDate());
        $this->assertEquals($data['deliveryDate'], $translation->getDeliveryDate());
        $this->assertEquals($data['title'], $translation->getTitle());
        $this->assertEquals($data['service'], $translation->getService());
        $this->assertEquals($data['department'], $translation->getDepartment());
        $this->assertEquals($data['contacts'], $translation->getContacts());
        $this->assertEquals($data['deliverToContacts'], $translation->getDeliverToContacts());
        $this->assertEquals($data['totalPrice'], $translation->getTotalPrice());
        $this->assertEquals($data['isInProgress'], $translation->isInProgress());
        $this->assertEquals($data['clientReference'], $translation->getClientReference());
        $this->assertEquals($data['deliveryModeCode'], $translation->getDeliveryModeCode());
        $this->assertEquals($data['departmentCode'], $translation->getDepartmentCode());
        $this->assertEquals($data['phoneNumber'], $translation->getPhoneNumber());
        $this->assertEquals($data['purposeCode'], $translation->getPurposeCode());
        $this->assertEquals($data['isQuotationOnly'], $translation->isQuotationOnly());
        $this->assertIsArray($translation->getSourceDocuments());
        $this->assertIsArray($translation->getReferenceFiles());
        $this->assertIsArray($translation->getBilingualFiles());
        $this->assertIsArray($translation->getTargetFiles());
        $this->assertIsArray($translation->getDates());
        $this->assertIsArray($translation->getComments());
        $this->assertIsArray($translation->getJobSummary());
        $this->assertIsArray($translation->getLinks());
    }
}
