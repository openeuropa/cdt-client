<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Callback;

use OpenEuropa\Tests\CdtClient\Traits\CallbackModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Callback\JobStatus
 */
class JobStatusTest extends TestCase
{
    use CallbackModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Callback\JobStatus
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'requestIdentifier' => 'TEST_ID',
            'status' => 'TEST_STATUS',
            'sourceDocumentName' => 'test_file.xml',
            'sourceLanguageCode' => 'PL',
            'targetLanguageCode' => 'ES',
        ];
        $jobStatus = $this->createCallbackJobStatus($data);

        $this->assertEquals($data['requestIdentifier'], $jobStatus->getRequestIdentifier());
        $this->assertEquals($data['status'], $jobStatus->getStatus());
        $this->assertEquals($data['sourceDocumentName'], $jobStatus->getSourceDocumentName());
        $this->assertEquals($data['sourceLanguageCode'], $jobStatus->getSourceLanguageCode());
        $this->assertEquals($data['targetLanguageCode'], $jobStatus->getTargetLanguageCode());
    }
}
