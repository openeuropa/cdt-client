<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Response;

use Symfony\Component\Serializer\Annotation\SerializedPath;

/**
 * Class JobSummary.
 *
 * Represents the job summary received from the CDT API.
 */
class JobSummary
{
    public float $totalPrice;

    public float $surchargeConfidentiality;

    public float $surchargeComplexity;

    public float $surchargeNonEuLanguage;

    public float $surchargeWebUpload;

    public float $basePrice;

    public float $volume;

    public string $sourceLanguage;

    public string $targetLanguage;

    public string $fileName;

    public string $priorityCode;

    #[SerializedPath('[serviceVolume][volume]')]
    protected float $serviceVolume;

    #[SerializedPath('[serviceVolume][unit]')]
    protected string $serviceVolumeUnit;

    #[SerializedPath('[serviceVolume][stringVolume]')]
    protected string $serviceVolumeString;

    public string $status;

    public bool $isEstimatedPrice;

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function getSurchargeConfidentiality(): float
    {
        return $this->surchargeConfidentiality;
    }

    public function setSurchargeConfidentiality(float $surchargeConfidentiality): self
    {
        $this->surchargeConfidentiality = $surchargeConfidentiality;
        return $this;
    }

    public function getSurchargeComplexity(): float
    {
        return $this->surchargeComplexity;
    }

    public function setSurchargeComplexity(float $surchargeComplexity): self
    {
        $this->surchargeComplexity = $surchargeComplexity;
        return $this;
    }

    public function getSurchargeNonEuLanguage(): float
    {
        return $this->surchargeNonEuLanguage;
    }

    public function setSurchargeNonEuLanguage(float $surchargeNonEuLanguage): self
    {
        $this->surchargeNonEuLanguage = $surchargeNonEuLanguage;
        return $this;
    }

    public function getSurchargeWebUpload(): float
    {
        return $this->surchargeWebUpload;
    }

    public function setSurchargeWebUpload(float $surchargeWebUpload): self
    {
        $this->surchargeWebUpload = $surchargeWebUpload;
        return $this;
    }

    public function getBasePrice(): float
    {
        return $this->basePrice;
    }

    public function setBasePrice(float $basePrice): self
    {
        $this->basePrice = $basePrice;
        return $this;
    }

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function setVolume(float $volume): self
    {
        $this->volume = $volume;
        return $this;
    }

    public function getSourceLanguage(): string
    {
        return $this->sourceLanguage;
    }

    public function setSourceLanguage(string $sourceLanguage): self
    {
        $this->sourceLanguage = $sourceLanguage;
        return $this;
    }

    public function getTargetLanguage(): string
    {
        return $this->targetLanguage;
    }

    public function setTargetLanguage(string $targetLanguage): self
    {
        $this->targetLanguage = $targetLanguage;
        return $this;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getPriorityCode(): string
    {
        return $this->priorityCode;
    }

    public function setPriorityCode(string $priorityCode): self
    {
        $this->priorityCode = $priorityCode;
        return $this;
    }

    public function getServiceVolume(): float
    {
        return $this->serviceVolume;
    }

    public function setServiceVolume(float $serviceVolume): self
    {
        $this->serviceVolume = $serviceVolume;
        return $this;
    }

    public function getServiceVolumeUnit(): string
    {
        return $this->serviceVolumeUnit;
    }

    public function setServiceVolumeUnit(string $serviceVolumeUnit): self
    {
        $this->serviceVolumeUnit = $serviceVolumeUnit;
        return $this;
    }

    public function getServiceVolumeString(): string
    {
        return $this->serviceVolumeString;
    }

    public function setServiceVolumeString(string $serviceVolumeString): self
    {
        $this->serviceVolumeString = $serviceVolumeString;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function isEstimatedPrice(): bool
    {
        return $this->isEstimatedPrice;
    }

    public function setIsEstimatedPrice(bool $isEstimatedPrice): self
    {
        $this->isEstimatedPrice = $isEstimatedPrice;
        return $this;
    }
}
