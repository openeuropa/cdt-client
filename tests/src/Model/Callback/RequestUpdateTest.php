<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Callback;

use OpenEuropa\Tests\CdtClient\Traits\CallbackModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Callback\RequestUpdate
 */
class RequestUpdateTest extends TestCase
{
    use CallbackModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Callback\RequestUpdate
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'requestIdentifier' => 'TEST_ID',
            'requestId' => '111',
            'jobId' => '222',
            'sourceLanguage' => 'ES',
            'targetLanguage' => 'PL',
            'documentName' => 'test_file.xml',
            'updateType' => 'TEST_UT',
            'propertiesChanges' => [],
        ];
        $requestUpdate = $this->createCallbackRequestUpdate($data);

        $this->assertEquals($data['requestIdentifier'], $requestUpdate->getRequestIdentifier());
        $this->assertEquals($data['requestId'], $requestUpdate->getRequestId());
        $this->assertEquals($data['jobId'], $requestUpdate->getJobId());
        $this->assertEquals($data['sourceLanguage'], $requestUpdate->getSourceLanguage());
        $this->assertEquals($data['targetLanguage'], $requestUpdate->getTargetLanguage());
        $this->assertEquals($data['documentName'], $requestUpdate->getDocumentName());
        $this->assertEquals($data['updateType'], $requestUpdate->getUpdateType());
        $this->assertEquals($data['propertiesChanges'], $requestUpdate->getPropertiesChanges());
    }
}
