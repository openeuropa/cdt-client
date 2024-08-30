<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\Response\CommentCollection;
use OpenEuropa\CdtClient\Model\Response\DateCollection;
use OpenEuropa\CdtClient\Model\Response\FileCollection;
use OpenEuropa\CdtClient\Model\Response\JobSummaryCollection;
use OpenEuropa\CdtClient\Model\Response\LinkCollection;
use OpenEuropa\CdtClient\Model\Response\ReferenceFileCollection;
use OpenEuropa\CdtClient\Model\Response\SourceDocumentCollection;
use OpenEuropa\CdtClient\Model\StringCollection;
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
            'creationDate' => new \DateTimeImmutable('2023-02-28T12:03:03.6239422'),
            'deliveryDate' => new \DateTimeImmutable('2023-03-07T16:00:00+01:00'),
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
        $this->assertInstanceOf(StringCollection::class, $translation->getSourceLanguages());
        $this->assertEquals($data['sourceLanguages'], (array) $translation->getSourceLanguages());
        $this->assertInstanceOf(StringCollection::class, $translation->getTargetLanguages());
        $this->assertEquals($data['targetLanguages'], (array) $translation->getTargetLanguages());
        $this->assertEquals($data['creationDate'], $translation->getCreationDate());
        $this->assertEquals($data['deliveryDate'], $translation->getDeliveryDate());
        $this->assertEquals($data['title'], $translation->getTitle());
        $this->assertEquals($data['service'], $translation->getService());
        $this->assertEquals($data['department'], $translation->getDepartment());
        $this->assertInstanceOf(StringCollection::class, $translation->getContacts());
        $this->assertEquals($data['contacts'], (array) $translation->getContacts());
        $this->assertInstanceOf(StringCollection::class, $translation->getDeliverToContacts());
        $this->assertEquals($data['deliverToContacts'], (array) $translation->getDeliverToContacts());
        $this->assertEquals($data['totalPrice'], $translation->getTotalPrice());
        $this->assertEquals($data['isInProgress'], $translation->isInProgress());
        $this->assertEquals($data['clientReference'], $translation->getClientReference());
        $this->assertEquals($data['deliveryModeCode'], $translation->getDeliveryModeCode());
        $this->assertEquals($data['departmentCode'], $translation->getDepartmentCode());
        $this->assertEquals($data['phoneNumber'], $translation->getPhoneNumber());
        $this->assertEquals($data['purposeCode'], $translation->getPurposeCode());
        $this->assertEquals($data['isQuotationOnly'], $translation->isQuotationOnly());
        $this->assertInstanceOf(SourceDocumentCollection::class, $translation->getSourceDocuments());
        $this->assertInstanceOf(ReferenceFileCollection::class, $translation->getReferenceFiles());
        $this->assertInstanceOf(FileCollection::class, $translation->getBilingualFiles());
        $this->assertInstanceOf(FileCollection::class, $translation->getTargetFiles());
        $this->assertInstanceOf(DateCollection::class, $translation->getDates());
        $this->assertInstanceOf(CommentCollection::class, $translation->getComments());
        $this->assertInstanceOf(JobSummaryCollection::class, $translation->getJobSummary());
        $this->assertInstanceOf(LinkCollection::class, $translation->getLinks());
    }
}
