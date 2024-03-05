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
     * The list of departments.
     *
     * @var array<int, ReferenceItem>
     */
    protected array $departments;

    /**
     * The list of priorities.
     *
     * @var array<int, ReferenceItem>
     */
    protected array $priorities;

    /**
     * The list of purposes.
     *
     * @var array<int, ReferenceItem>
     */
    protected array $purposes;

    /**
     * The list of delivery modes.
     *
     * @var array<int, ReferenceItem>
     */
    protected array $deliveryModes;

    /**
     * The list of confidentialities.
     *
     * @var array<int, ReferenceItem>
     */
    protected array $confidentialities;

    /**
     * The list of languages.
     *
     * @var array<int, string>
     */
    protected array $languages;

    /**
     * The list of statuses.
     *
     * @var array<int, ReferenceItem>
     */
    protected array $statuses;

    /**
     * The list of services.
     *
     * @var array<int, ReferenceItem>
     */
    protected array $services;

    /**
     * The list of send options.
     *
     * @var array<int, ReferenceItem>
     */
    protected array $sendOptions;

    /**
     * The contacts for the translation service.
     *
     * @var array<int, ReferenceContact>
     */
    protected array $contacts;

    /**
     * @return array<int, ReferenceItem>
     */
    public function getDepartments(): array
    {
        return $this->departments;
    }

    /**
     * @param array<int, ReferenceItem> $departments
     */
    public function setDepartments(array $departments): self
    {
        $this->departments = $departments;
        return $this;
    }

    /**
     * @return array<int, ReferenceItem>
     */
    public function getPriorities(): array
    {
        return $this->priorities;
    }

    /**
     * @param array<int, ReferenceItem> $priorities
     */
    public function setPriorities(array $priorities): self
    {
        $this->priorities = $priorities;
        return $this;
    }

    /**
     * @return array<int, ReferenceItem>
     */
    public function getPurposes(): array
    {
        return $this->purposes;
    }

    /**
     * @param array<int, ReferenceItem> $purposes
     */
    public function setPurposes(array $purposes): self
    {
        $this->purposes = $purposes;
        return $this;
    }

    /**
     * @return array<int, ReferenceItem>
     */
    public function getDeliveryModes(): array
    {
        return $this->deliveryModes;
    }

    /**
     * @param array<int, ReferenceItem> $deliveryModes
     */
    public function setDeliveryModes(array $deliveryModes): self
    {
        $this->deliveryModes = $deliveryModes;
        return $this;
    }

    /**
     * @return array<int, ReferenceItem>
     */
    public function getConfidentialities(): array
    {
        return $this->confidentialities;
    }

    /**
     * @param array<int, ReferenceItem> $confidentialities
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
     * @return array<int, ReferenceItem>
     */
    public function getStatuses(): array
    {
        return $this->statuses;
    }

    /**
     * @param array<int, ReferenceItem> $statuses
     */
    public function setStatuses(array $statuses): self
    {
        $this->statuses = $statuses;
        return $this;
    }

    /**
     * @return array<int, ReferenceItem>
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @param array<int, ReferenceItem> $services
     */
    public function setServices(array $services): self
    {
        $this->services = $services;
        return $this;
    }

    /**
     * @return array<int, ReferenceItem>
     */
    public function getSendOptions(): array
    {
        return $this->sendOptions;
    }

    /**
     * @param array<int, ReferenceItem> $sendOptions
     */
    public function setSendOptions(array $sendOptions): self
    {
        $this->sendOptions = $sendOptions;
        return $this;
    }

    /**
     * @return array<int, ReferenceContact>
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * @param array<int, ReferenceContact> $contacts
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = $contacts;
        return $this;
    }
}
