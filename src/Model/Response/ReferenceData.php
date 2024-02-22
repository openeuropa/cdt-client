<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

/**
 * Class ReferenceData.
 *
 * Represents the business reference data obtained from the CDT API.
 * Stores the list of departments, priorities, purposes, delivery modes,
 * confidentialities, languages, statuses, services and send options.
 * It also contains the contact data for the translation service.
 */
class ReferenceData
{

    /**
     * The list of departments (code and description).
     * Ex. 250772 / Service Finance
     *
     * @var ReferenceItem[]
     */
    protected array $departments;

    /**
     * The list of priorities (code and description).
     * ex. VU / Very Urgent.
     *
     * @var ReferenceItem[]
     */
    protected array $priorities;

    /**
     * The list of purposes (code and description).
     * ex. LT / Legal text.
     *
     * @var ReferenceItem[]
     */
    protected array $purposes;

    /**
     * The list of delivery modes (code and description).
     * ex. YesMF / Yes(Multiple Files).
     *
     * @var ReferenceItem[]
     */
    protected array $deliveryModes;

    /**
     * The list of confidentialities (code and description).
     * ex. SC / Classified.
     *
     * @var ReferenceItem[]
     */
    protected array $confidentialities;

    /**
     * The list of languages (just values).
     * ex. AR, AZ, EN.
     *
     * @var array<string>
     */
    protected array $languages;

    /**
     * The list of statuses (code and description).
     * ex. INPR / In Progress.
     *
     * @var ReferenceItem[]
     */
    protected array $statuses;

    /**
     * The list of services (code and description).
     * ex. Subtitling / Subtitling.
     *
     * @var ReferenceItem[]
     */
    protected array $services;

    /**
     * The list of send options (code and description).
     * ex. SendAsDraft / Send as draft.
     *
     * @var ReferenceItem[]
     */
    protected array $sendOptions;

    /**
     * The contacts for the translation service.
     *
     * @var ReferenceContact[]
     */
    protected array $contacts;

    /**
     * @return ReferenceItem[]
     */
    public function getDepartments(): array
    {
        return $this->departments;
    }

    /**
     * @param ReferenceItem[] $departments
     * @return self
     */
    public function setDepartments(array $departments): self
    {
        $this->departments = $departments;
        return $this;
    }

    /**
     * @return ReferenceItem[]
     */
    public function getPriorities(): array
    {
        return $this->priorities;
    }

    /**
     * @param ReferenceItem[] $priorities
     * @return self
     */
    public function setPriorities(array $priorities): self
    {
        $this->priorities = $priorities;
        return $this;
    }

    /**
     * @return ReferenceItem[]
     */
    public function getPurposes(): array
    {
        return $this->purposes;
    }

    /**
     * @param ReferenceItem[] $purposes
     * @return self
     */
    public function setPurposes(array $purposes): self
    {
        $this->purposes = $purposes;
        return $this;
    }

    /**
     * @return ReferenceItem[]
     */
    public function getDeliveryModes(): array
    {
        return $this->deliveryModes;
    }

    /**
     * @param ReferenceItem[] $deliveryModes
     * @return self
     */
    public function setDeliveryModes(array $deliveryModes): self
    {
        $this->deliveryModes = $deliveryModes;
        return $this;
    }

    /**
     * @return ReferenceItem[]
     */
    public function getConfidentialities(): array
    {
        return $this->confidentialities;
    }

    /**
     * @param ReferenceItem[] $confidentialities
     * @return self
     */
    public function setConfidentialities(array $confidentialities): self
    {
        $this->confidentialities = $confidentialities;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @param string[] $languages
     * @return self
     */
    public function setLanguages(array $languages): self
    {
        $this->languages = $languages;
        return $this;
    }

    /**
     * @return ReferenceItem[]
     */
    public function getStatuses(): array
    {
        return $this->statuses;
    }

    /**
     * @param ReferenceItem[] $statuses
     * @return self
     */
    public function setStatuses(array $statuses): self
    {
        $this->statuses = $statuses;
        return $this;
    }

    /**
     * @return ReferenceItem[]
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @param ReferenceItem[] $services
     * @return self
     */
    public function setServices(array $services): self
    {
        $this->services = $services;
        return $this;
    }

    /**
     * @return ReferenceItem[]
     */
    public function getSendOptions(): array
    {
        return $this->sendOptions;
    }

    /**
     * @param ReferenceItem[] $sendOptions
     * @return self
     */
    public function setSendOptions(array $sendOptions): self
    {
        $this->sendOptions = $sendOptions;
        return $this;
    }

    /**
     * @return ReferenceContact[]
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * @param ReferenceContact[] $contacts
     * @return self
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = $contacts;
        return $this;
    }
}
