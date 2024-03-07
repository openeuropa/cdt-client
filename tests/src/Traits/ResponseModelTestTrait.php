<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\Response\Comment;
use OpenEuropa\CdtClient\Model\Response\Date;
use OpenEuropa\CdtClient\Model\Response\File;
use OpenEuropa\CdtClient\Model\Response\JobSummary;
use OpenEuropa\CdtClient\Model\Response\Link;
use OpenEuropa\CdtClient\Model\Response\ReferenceContact;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Model\Response\ReferenceFile;
use OpenEuropa\CdtClient\Model\Response\ReferenceItem;
use OpenEuropa\CdtClient\Model\Response\SourceDocument;
use OpenEuropa\CdtClient\Model\Response\Translation;

/**
 * Trait ResponseModelTestTrait
 *
 * Provides helper methods for testing classes that utilize the response data models.
 */
trait ResponseModelTestTrait
{
    /**
     * @param array<string, mixed> $data
     */
    public function createResponseReferenceData(array $data = []): ReferenceData
    {
        return (new ReferenceData())
            ->setDepartments($data['departments'] ? $this->createResponseReferenceItemList($data['departments']) : [$this->createResponseReferenceItem()])
            ->setPriorities($data['priorities'] ? $this->createResponseReferenceItemList($data['priorities']) : [$this->createResponseReferenceItem()])
            ->setPurposes($data['purposes'] ? $this->createResponseReferenceItemList($data['purposes']) : [$this->createResponseReferenceItem()])
            ->setDeliveryModes($data['deliveryModes'] ? $this->createResponseReferenceItemList($data['deliveryModes']) : [$this->createResponseReferenceItem()])
            ->setConfidentialities($data['confidentialities'] ? $this->createResponseReferenceItemList($data['confidentialities']) : [$this->createResponseReferenceItem()])
            ->setLanguages($data['languages'] ?? ['EN'])
            ->setStatuses($data['statuses'] ? $this->createResponseReferenceItemList($data['statuses']) : [$this->createResponseReferenceItem()])
            ->setServices($data['services'] ? $this->createResponseReferenceItemList($data['services']) : [$this->createResponseReferenceItem()])
            ->setSendOptions($data['sendOptions'] ? $this->createResponseReferenceItemList($data['sendOptions']) : [$this->createResponseReferenceItem()])
            ->setContacts($data['contacts'] ? $this->createResponseReferenceContactList($data['contacts']) : [$this->createResponseReferenceContact()]);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createResponseReferenceItem(array $data = []): ReferenceItem
    {
        return (new ReferenceItem())
            ->setCode($data['code'] ?? 'test')
            ->setDescription($data['description'] ?? 'Test');
    }

    /**
     * @param array<int, mixed> $data
     * @return array<int, ReferenceItem>
     */
    public function createResponseReferenceItemList(array $data = []): array
    {
        $result = [];
        foreach ($data as $item) {
            $result[] = $this->createResponseReferenceItem($item);
        }
        return $result;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createResponseReferenceContact(array $data = []): ReferenceContact
    {
        return (new ReferenceContact())
            ->setEmail($data['email'] ?? 'someone@example.com')
            ->setPhoneNumber($data['phoneNumber'] ?? '1234567890')
            ->setPhoneCountryCode($data['phoneCountryCode'] ?? '')
            ->setCountryCode($data['countryCode'] ?? '')
            ->setCountryName($data['countryName'] ?? '')
            ->setFirstName($data['firstName'] ?? 'John')
            ->setLastName($data['lastName'] ?? 'Smith')
            ->setUserName($data['userName'] ?? 'DGTRADETUCE');
    }

    /**
     * @param array<int, mixed> $data
     * @return array<int, ReferenceContact>
     */
    public function createResponseReferenceContactList(array $data = []): array
    {
        $result = [];
        foreach ($data as $contact) {
            $result[] = $this->createResponseReferenceContact($contact);
        }
        return $result;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createResponseFile(array $data = []): File
    {
        return (new File())
            ->setFilename($data['fileName'] ?? 'test.xml')
            ->setSourceLanguage($data['sourceLanguage'] ?? 'EN')
            ->setTargetLanguage($data['targetLanguage'] ?? 'FR')
            ->setSourceDocument($data['sourceDocument'] ?? 'test.xml')
            ->setIsPrivate($data['isPrivate'] ?? false)
            ->setContent($data['content'] ?? 'The Content')
            ->setLinks($this->createResponseObjectList(
                $data['links'] ?? null,
                [$this, 'createResponseLink'],
                'first'
            ));
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createResponseLink(array $data = []): Link
    {
        return (new Link())
            ->setHref($data['href'] ?? 'http://example.com')
            ->setMethod($data['method'] ?? 'GET');
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createResponseSourceDocument(array $data = []): SourceDocument
    {
        return (new SourceDocument())
            ->setFileName($data['fileName'] ?? 'test.xml')
            ->setIsPrivate($data['isPrivate'] ?? false)
            ->setLinks($this->createResponseObjectList(
                $data['links'] ?? null,
                [$this, 'createResponseLink'],
                'first'
            ));
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createResponseComment(array $data = []): Comment
    {
        return (new Comment())
            ->setComment($data['comment'] ?? 'This is a comment')
            ->setIsHTML($data['isHTML'] ?? false)
            ->setFrom($data['from'] ?? 'John Doe');
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createResponseDate(array $data = []): Date
    {
        return (new Date())
            ->setDate($data['date'] ?? new \DateTime('2024-03-07T16:00:00+01:00'))
            ->setLabel($data['label'] ?? 'Date')
            ->setEcdtDateType($data['ecdtDateType'] ?? 'Deadline')
            ->setTooltip($data['tooltip'] ?? 'This is a date');
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createResponseJobSummary(array $data = []): JobSummary
    {
        return (new JobSummary())
            ->setTotalPrice($data['totalPrice'] ?? 240.5)
            ->setSurchargeConfidentiality($data['surchargeConfidentiality'] ?? 20.5)
            ->setSurchargeComplexity($data['surchargeComplexity'] ?? 30.0)
            ->setSurchargeNonEuLanguage($data['surchargeNonEuLanguage'] ?? 40.0)
            ->setSurchargeWebUpload($data['surchargeWebUpload'] ?? 50.0)
            ->setBasePrice($data['basePrice'] ?? 100.0)
            ->setVolume($data['volume'] ?? 0.5)
            ->setSourceLanguage($data['sourceLanguage'] ?? 'EN')
            ->setTargetLanguage($data['targetLanguage'] ?? 'FR')
            ->setFileName($data['fileName'] ?? 'test.xml')
            ->setPriorityCode($data['priorityCode'] ?? 'UR')
            ->setServiceVolume($data['serviceVolume'] ?? 20)
            ->setServiceVolumeUnit($data['serviceVolumeUnit'] ?? 'w')
            ->setServiceVolumeString($data['serviceVolumeString'] ?? 'word')
            ->setStatus($data['status'] ?? 'new')
            ->setIsEstimatedPrice($data['isEstimatedPrice'] ?? false);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createResponseReferenceFile(array $data = []): ReferenceFile
    {
        return (new ReferenceFile())
            ->setLanguages($data['languages'] ?? ['EN', 'FR'])
            ->setFileName($data['fileName'] ?? 'test.xml')
            ->setIsPrivate($data['isPrivate'] ?? false)
            ->setLinks($this->createResponseObjectList(
                $data['links'] ?? null,
                [$this, 'createResponseLink'],
                'first'
            ));
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createResponseTranslation(array $data = []): Translation
    {
        return (new Translation())
            ->setRequestIdentifier($data['requestIdentifier'] ?? '123456')
            ->setStatus($data['status'] ?? 'new')
            ->setSourceLanguages($data['sourceLanguages'] ?? ['EN'])
            ->setTargetLanguages($data['targetLanguages'] ?? ['FR'])
            ->setCreationDate($data['creationDate'] ?? new \DateTime('2024-02-28T12:03:03.6239422'))
            ->setDeliveryDate(array_key_exists('deliveryDate', $data) ? $data['deliveryDate'] : new \DateTime('2024-03-07T16:00:00+01:00'))
            ->setTitle($data['title'] ?? 'Test translation')
            ->setService($data['service'] ?? 'translation')
            ->setDepartment($data['department'] ?? 'TR')
            ->setContacts($data['contacts'] ?? ['JohnDoe'])
            ->setDeliverToContacts($data['deliverToContacts'] ?? ['JaneSmith'])
            ->setSourceDocuments($this->createResponseObjectList(
                $data['sourceDocuments'] ?? null,
                [$this, 'createResponseSourceDocument'],
            ))
            ->setReferenceFiles($this->createResponseObjectList(
                $data['referenceFiles'] ?? null,
                [$this, 'createResponseReferenceFile'],
            ))
            ->setBilingualFiles($this->createResponseObjectList(
                $data['bilingualFiles'] ?? null,
                [$this, 'createResponseFile'],
            ))
            ->setTargetFiles($this->createResponseObjectList(
                $data['targetFiles'] ?? null,
                [$this, 'createResponseFile'],
            ))
            ->setDates($this->createResponseObjectList(
                $data['dates'] ?? null,
                [$this, 'createResponseDate'],
                'first'
            ))
            ->setComments($this->createResponseObjectList(
                $data['comments'] ?? null,
                [$this, 'createResponseComment'],
                'first'
            ))
            ->setTotalPrice($data['totalPrice'] ?? 240.5)
            ->setJobSummary($this->createResponseObjectList(
                $data['jobSummary'] ?? null,
                [$this, 'createResponseJobSummary'],
            ))
            ->setIsInProgress($data['isInProgress'] ?? false)
            ->setClientReference($data['clientReference'] ?? '123456')
            ->setDeliveryModeCode($data['deliveryModeCode'] ?? 'EML')
            ->setDepartmentCode($data['departmentCode'] ?? 'TR')
            ->setPhoneNumber($data['phoneNumber'] ?? '1234567890')
            ->setPurposeCode($data['purposeCode'] ?? 'TR')
            ->setIsQuotationOnly($data['isQuotationOnly'] ?? false)
            ->setLinks($this->createResponseObjectList(
                $data['links'] ?? null,
                [$this, 'createResponseLink'],
                'first'
            ));
    }

    /**
     * @param array<string, mixed> $data
     *
     * @return array<int, File>
     */
    public function createResponseFileList(array $data): array
    {
        return $this->createResponseObjectList(
            $data,
            [$this, 'createResponseFile'],
        );
    }

    /**
     * @param array<mixed>|null $items
     * @return array<mixed>
     */
    public function createResponseObjectList(?array $items, callable $callback, string|int $defaultKey = 0): array
    {
        if (!is_null($items)) {
            $objects = [];
            foreach ($items as $key => $item) {
                $objects[$key] = $callback($item);
            }
        } else {
            $objects = [$defaultKey => $callback([])];
        }
        return $objects;
    }
}
