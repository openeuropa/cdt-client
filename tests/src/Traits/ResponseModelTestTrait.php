<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\Response\ReferenceContact;
use OpenEuropa\CdtClient\Model\Response\ReferenceContactCollection;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Model\Response\ReferenceItem;
use OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection;

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
            ->setDepartments(new ReferenceItemCollection($data['departments'] ?? [$this->createResponseReferenceItem()]))
            ->setPriorities(new ReferenceItemCollection($data['priorities'] ?? [$this->createResponseReferenceItem()]))
            ->setPurposes(new ReferenceItemCollection($data['purposes'] ?? [$this->createResponseReferenceItem()]))
            ->setDeliveryModes(new ReferenceItemCollection($data['deliveryModes'] ?? [$this->createResponseReferenceItem()]))
            ->setConfidentialities(new ReferenceItemCollection($data['confidentialities'] ?? [$this->createResponseReferenceItem()]))
            ->setLanguages($data['languages'] ?? ['EN'])
            ->setStatuses(new ReferenceItemCollection($data['statuses'] ?? [$this->createResponseReferenceItem()]))
            ->setServices(new ReferenceItemCollection($data['services'] ?? [$this->createResponseReferenceItem()]))
            ->setSendOptions(new ReferenceItemCollection($data['sendOptions'] ?? [$this->createResponseReferenceItem()]))
            ->setContacts(new ReferenceContactCollection($data['contacts'] ?? [$this->createResponseReferenceContact()]));
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
     * Creates a ReferenceContact response object.
     *
     * @param array<string, mixed> $data
     */
    public function createResponseReferenceContact(array $data = []): ReferenceContact
    {
        return (new ReferenceContact())
            ->setEmail($data['email'] ?? 'someone@example.com')
            ->setPhoneNumber($data['phone'] ?? '1234567890')
            ->setPhoneCountryCode($data['phoneCountryCode'] ?? '')
            ->setCountryCode($data['countryCode'] ?? '')
            ->setCountryName($data['countryName'] ?? '')
            ->setFirstName($data['firstName'] ?? 'John')
            ->setLastName($data['lastName'] ?? 'Doe')
            ->setUserName($data['userName'] ?? 'DGTRADETUCE');
    }
}
