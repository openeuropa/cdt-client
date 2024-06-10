<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

/**
 * Class ReferenceData.
 *
 * Represents the business reference data received from the CDT API.
 */
class ReferenceData
{
    /**
     * @var array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    protected array $departments;

    /**
     * @var array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    protected array $priorities;

    /**
     * @var array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    protected array $purposes;

    /**
     * @var array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    protected array $deliveryModes;

    /**
     * @var array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    protected array $confidentialities;

    /**
     * @var array<int, string>
     */
    protected array $languages;

    /**
     * @var array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    protected array $statuses;

    /**
     * @var array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    protected array $services;

    /**
     * @var array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    protected array $sendOptions;

    /**
     * @var array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceContact>
     */
    protected array $contacts;

    /**
     * @return array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    public function getDepartments(): array
    {
        return $this->departments;
    }

    /**
     * @param array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $departments
     */
    public function setDepartments(array $departments): self
    {
        $this->departments = $departments;

        return $this;
    }

    /**
     * @return array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    public function getPriorities(): array
    {
        return $this->priorities;
    }

    /**
     * @param array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $priorities
     */
    public function setPriorities(array $priorities): self
    {
        $this->priorities = $priorities;

        return $this;
    }

    /**
     * @return array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    public function getPurposes(): array
    {
        return $this->purposes;
    }

    /**
     * @param array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $purposes
     */
    public function setPurposes(array $purposes): self
    {
        $this->purposes = $purposes;

        return $this;
    }

    /**
     * @return array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    public function getDeliveryModes(): array
    {
        return $this->deliveryModes;
    }

    /**
     * @param array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $deliveryModes
     */
    public function setDeliveryModes(array $deliveryModes): self
    {
        $this->deliveryModes = $deliveryModes;

        return $this;
    }

    /**
     * @return array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    public function getConfidentialities(): array
    {
        return $this->confidentialities;
    }

    /**
     * @param array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $confidentialities
     */
    public function setConfidentialities(array $confidentialities): self
    {
        $this->confidentialities = $confidentialities;

        return $this;
    }

    /**
     * @return array<int, string>
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @param array<int, string> $languages
     */
    public function setLanguages(array $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * @return array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    public function getStatuses(): array
    {
        return $this->statuses;
    }

    /**
     * @param array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $statuses
     */
    public function setStatuses(array $statuses): self
    {
        $this->statuses = $statuses;

        return $this;
    }

    /**
     * @return array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @param array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $services
     */
    public function setServices(array $services): self
    {
        $this->services = $services;

        return $this;
    }

    /**
     * @return array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem>
     */
    public function getSendOptions(): array
    {
        return $this->sendOptions;
    }

    /**
     * @param array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $sendOptions
     */
    public function setSendOptions(array $sendOptions): self
    {
        $this->sendOptions = $sendOptions;

        return $this;
    }

    /**
     * @return array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceContact>
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * @param array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceContact> $contacts
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }
}
