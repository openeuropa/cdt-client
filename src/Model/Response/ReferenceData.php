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
     */
    protected ReferenceItemCollection $departments;

    /**
     * The list of priorities.
     */
    protected ReferenceItemCollection $priorities;

    /**
     * The list of purposes.
     */
    protected ReferenceItemCollection $purposes;

    /**
     * The list of delivery modes.
     */
    protected ReferenceItemCollection $deliveryModes;

    /**
     * The list of confidentialities.
     */
    protected ReferenceItemCollection $confidentialities;

    /**
     * The list of languages.
     *
     * @var array<int, string>
     */
    protected array $languages;

    /**
     * The list of statuses.
     */
    protected ReferenceItemCollection $statuses;

    /**
     * The list of services.
     */
    protected ReferenceItemCollection $services;

    /**
     * The list of send options.
     */
    protected ReferenceItemCollection $sendOptions;

    /**
     * The contacts for the translation service.
     */
    protected ReferenceContactCollection $contacts;

    public function getDepartments(): ReferenceItemCollection
    {
        return $this->departments;
    }

    /**
     * @param ReferenceItemCollection|array<int, array<string, string>> $departments
     */
    public function setDepartments(ReferenceItemCollection|array $departments): self
    {
        $this->departments = is_array($departments) ? new ReferenceItemCollection($departments) : $departments;
        return $this;
    }

    public function getPriorities(): ReferenceItemCollection
    {
        return $this->priorities;
    }

    /**
     * @param ReferenceItemCollection|array<int, array<string, string>> $priorities
     */
    public function setPriorities(ReferenceItemCollection|array $priorities): self
    {
        $this->priorities = is_array($priorities) ? new ReferenceItemCollection($priorities) : $priorities;
        return $this;
    }

    public function getPurposes(): ReferenceItemCollection
    {
        return $this->purposes;
    }

    /**
     * @param ReferenceItemCollection|array<int, array<string, string>> $purposes
     */
    public function setPurposes(ReferenceItemCollection|array $purposes): self
    {
        $this->purposes = is_array($purposes) ? new ReferenceItemCollection($purposes) : $purposes;
        return $this;
    }

    public function getDeliveryModes(): ReferenceItemCollection
    {
        return $this->deliveryModes;
    }

    /**
     * @param ReferenceItemCollection|array<int, array<string, string>> $deliveryModes
     */
    public function setDeliveryModes(ReferenceItemCollection|array $deliveryModes): self
    {
        $this->deliveryModes = is_array($deliveryModes) ? new ReferenceItemCollection($deliveryModes) : $deliveryModes;
        return $this;
    }

    public function getConfidentialities(): ReferenceItemCollection
    {
        return $this->confidentialities;
    }

    /**
     * @param ReferenceItemCollection|array<int, array<string, string>> $confidentialities
     */
    public function setConfidentialities(ReferenceItemCollection|array $confidentialities): self
    {
        $this->confidentialities = is_array($confidentialities) ? new ReferenceItemCollection($confidentialities) : $confidentialities;
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

    public function getStatuses(): ReferenceItemCollection
    {
        return $this->statuses;
    }

    /**
     * @param ReferenceItemCollection|array<int, array<string, string>> $statuses
     */
    public function setStatuses(ReferenceItemCollection|array $statuses): self
    {
        $this->statuses = is_array($statuses) ? new ReferenceItemCollection($statuses) : $statuses;
        return $this;
    }

    public function getServices(): ReferenceItemCollection
    {
        return $this->services;
    }

    /**
     * @param ReferenceItemCollection|array<int, array<string, string>> $services
     */
    public function setServices(ReferenceItemCollection|array $services): self
    {
        $this->services = is_array($services) ? new ReferenceItemCollection($services) : $services;
        return $this;
    }

    public function getSendOptions(): ReferenceItemCollection
    {
        return $this->sendOptions;
    }

    /**
     * @param ReferenceItemCollection|array<int, array<string, string>> $sendOptions
     */
    public function setSendOptions(ReferenceItemCollection|array $sendOptions): self
    {
        $this->sendOptions = is_array($sendOptions) ? new ReferenceItemCollection($sendOptions) : $sendOptions;
        return $this;
    }

    public function getContacts(): ReferenceContactCollection
    {
        return $this->contacts;
    }

    /**
     * @param ReferenceContactCollection|array<int, array<string, string>> $contacts
     */
    public function setContacts(ReferenceContactCollection|array $contacts): self
    {
        $this->contacts = is_array($contacts) ? new ReferenceContactCollection($contacts) : $contacts;
        return $this;
    }
}
