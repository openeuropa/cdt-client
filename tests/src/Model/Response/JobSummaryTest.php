<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\JobSummary
 */
class JobSummaryTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\JobSummary
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'totalPrice' => 24.5,
            'surchargeConfidentiality' => 2.5,
            'surchargeComplexity' => 3.0,
            'surchargeNonEuLanguage' => 4.0,
            'surchargeWebUpload' => 5.0,
            'basePrice' => 00.0,
            'volume' => 0.5,
            'sourceLanguage' => 'FR',
            'targetLanguage' => 'PL',
            'fileName' => 'test1.xml',
            'priorityCode' => 'LO',
            'serviceVolume' => 200,
            'serviceVolumeUnit' => 'l',
            'serviceVolumeString' => 'letter',
            'status' => 'inprogress',
            'isEstimatedPrice' => true,
        ];
        $jobSummary = $this->createResponseJobSummary($data);

        $this->assertEquals($data['totalPrice'], $jobSummary->getTotalPrice());
        $this->assertEquals($data['surchargeConfidentiality'], $jobSummary->getSurchargeConfidentiality());
        $this->assertEquals($data['surchargeComplexity'], $jobSummary->getSurchargeComplexity());
        $this->assertEquals($data['surchargeNonEuLanguage'], $jobSummary->getSurchargeNonEuLanguage());
        $this->assertEquals($data['surchargeWebUpload'], $jobSummary->getSurchargeWebUpload());
        $this->assertEquals($data['basePrice'], $jobSummary->getBasePrice());
        $this->assertEquals($data['volume'], $jobSummary->getVolume());
        $this->assertEquals($data['sourceLanguage'], $jobSummary->getSourceLanguage());
        $this->assertEquals($data['targetLanguage'], $jobSummary->getTargetLanguage());
        $this->assertEquals($data['fileName'], $jobSummary->getFileName());
        $this->assertEquals($data['priorityCode'], $jobSummary->getPriorityCode());
        $this->assertEquals($data['serviceVolume'], $jobSummary->getServiceVolume());
        $this->assertEquals($data['serviceVolumeUnit'], $jobSummary->getServiceVolumeUnit());
        $this->assertEquals($data['serviceVolumeString'], $jobSummary->getServiceVolumeString());
        $this->assertEquals($data['status'], $jobSummary->getStatus());
        $this->assertEquals($data['isEstimatedPrice'], $jobSummary->isEstimatedPrice());
    }
}
