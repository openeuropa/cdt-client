<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\Response\ReferenceContact;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Model\Response\ReferenceItem;

/**
 * Trait ResponseModelTestTrait
 *
 * Provides helper methods for testing classes that utilize the response data models.
 */
trait ResponseModelTestTrait
{
    /**
     * Creates a ReferenceData response object.
     *
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
     * Creates a ReferenceItem response object.
     *
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
     * Creates a ReferenceContact response object.
     *
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
}
