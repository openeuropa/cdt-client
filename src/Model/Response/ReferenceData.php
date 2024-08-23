<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use OpenEuropa\CdtClient\Model\StringCollection;

/**
 * Class ReferenceData.
 *
 * Represents the business reference data received from the CDT API.
 */
class ReferenceData
{
    protected ReferenceItemCollection $departments;

    protected ReferenceItemCollection $priorities;

    protected ReferenceItemCollection $purposes;

    protected ReferenceItemCollection $deliveryModes;

    protected ReferenceItemCollection $confidentialities;

    protected StringCollection $languages;

    protected ReferenceItemCollection $statuses;

    protected ReferenceItemCollection $services;

    protected ReferenceItemCollection $sendOptions;

    protected ReferenceContactCollection $contacts;

    public function getDepartments(): ReferenceItemCollection
    {
        return $this->departments;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection|array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $departments
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
     * @param \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection|array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $priorities
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
     * @param \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection|array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $purposes
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
     * @param \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection|array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $deliveryModes
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
     * @param \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection|array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $confidentialities
     */
    public function setConfidentialities(ReferenceItemCollection|array $confidentialities): self
    {
        $this->confidentialities = is_array($confidentialities) ? new ReferenceItemCollection($confidentialities) : $confidentialities;

        return $this;
    }

    public function getLanguages(): StringCollection
    {
        return $this->languages;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\StringCollection|array<int, string> $languages
     */
    public function setLanguages(StringCollection|array $languages): self
    {
        $this->languages = is_array($languages) ? new StringCollection($languages) : $languages;

        return $this;
    }

    public function getStatuses(): ReferenceItemCollection
    {
        return $this->statuses;
    }

    /**
     * @param \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection|array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $statuses
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
     * @param \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection|array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $services
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
     * @param \OpenEuropa\CdtClient\Model\Response\ReferenceItemCollection|array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceItem> $sendOptions
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
     * @param \OpenEuropa\CdtClient\Model\Response\ReferenceContactCollection|array<int, \OpenEuropa\CdtClient\Model\Response\ReferenceContact> $contacts
     */
    public function setContacts(ReferenceContactCollection|array $contacts): self
    {
        $this->contacts = is_array($contacts) ? new ReferenceContactCollection($contacts) : $contacts;

        return $this;
    }
}
