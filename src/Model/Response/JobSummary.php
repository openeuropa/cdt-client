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

    /**
     * Total price.
     * @todo This should be a float or decimal.
     */
    public int $totalPrice;

    /**
     * Surcharge for confidentiality.
     * @todo This should be a float or decimal.
     */
    public int $surchargeConfidentiality;

    /**
     * Surcharge for complexity.
     * @todo This should be a float or decimal.
     */
    public int $surchargeComplexity;

    /**
     * Surcharge for non-EU language.
     * @todo This should be a float or decimal.
     */
    public int $surchargeNonEuLanguage;

    /**
     * Surcharge for web upload.
     * @todo This should be a float or decimal.
     */
    public int $surchargeWebUpload;

    /**
     * Base price.
     * @todo This should be a float or decimal.
     */
    public int $basePrice;

    /**
     * Volume.
     */
    public int $volume;

    /**
     * Source language.
     */
    public string $sourceLanguage;

    /**
     * Target language.
     */
    public string $targetLanguage;

    /**
     * File name.
     */
    public string $fileName;

    /**
     * Priority code.
     */
    public string $priorityCode;

    /**
     * The service volume.
     */
    #[SerializedPath('[serviceVolume][volume]')]
    protected int $serviceVolume;

    /**
     * The service volume unit.
     */
    #[SerializedPath('[serviceVolume][unit]')]
    protected string $serviceVolumeUnit;

    /**
     * The service volume string.
     */
    #[SerializedPath('[serviceVolume][stringVolume]')]
    protected string $serviceVolumeString;

    /**
     * Status.
     */
    public string $status;

    /**
     * Is estimated price.
     */
    public bool $isEstimatedPrice;
}
