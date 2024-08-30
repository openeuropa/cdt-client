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

    public function setDepartments(ReferenceItemCollection $departments): self
    {
        $this->departments = $departments;

        return $this;
    }

    public function getPriorities(): ReferenceItemCollection
    {
        return $this->priorities;
    }

    public function setPriorities(ReferenceItemCollection $priorities): self
    {
        $this->priorities = $priorities;

        return $this;
    }

    public function getPurposes(): ReferenceItemCollection
    {
        return $this->purposes;
    }

    public function setPurposes(ReferenceItemCollection $purposes): self
    {
        $this->purposes = $purposes;

        return $this;
    }

    public function getDeliveryModes(): ReferenceItemCollection
    {
        return $this->deliveryModes;
    }

    public function setDeliveryModes(ReferenceItemCollection $deliveryModes): self
    {
        $this->deliveryModes = $deliveryModes;

        return $this;
    }

    public function getConfidentialities(): ReferenceItemCollection
    {
        return $this->confidentialities;
    }

    public function setConfidentialities(ReferenceItemCollection $confidentialities): self
    {
        $this->confidentialities = $confidentialities;

        return $this;
    }

    public function getLanguages(): StringCollection
    {
        return $this->languages;
    }

    public function setLanguages(StringCollection $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getStatuses(): ReferenceItemCollection
    {
        return $this->statuses;
    }

    public function setStatuses(ReferenceItemCollection $statuses): self
    {
        $this->statuses = $statuses;

        return $this;
    }

    public function getServices(): ReferenceItemCollection
    {
        return $this->services;
    }

    public function setServices(ReferenceItemCollection $services): self
    {
        $this->services = $services;

        return $this;
    }

    public function getSendOptions(): ReferenceItemCollection
    {
        return $this->sendOptions;
    }

    public function setSendOptions(ReferenceItemCollection $sendOptions): self
    {
        $this->sendOptions = $sendOptions;

        return $this;
    }

    public function getContacts(): ReferenceContactCollection
    {
        return $this->contacts;
    }

    public function setContacts(ReferenceContactCollection $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }
}
