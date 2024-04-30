<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Serializer;

use OpenEuropa\CdtClient\Serializer\CallbackSerializer;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Serializer\CallbackSerializer
 */
class CallbackSerializerTest extends TestCase
{
    /**
     * @covers \OpenEuropa\CdtClient\Serializer\CallbackSerializer
     */
    public function testRequestStatus(): void
    {
        $data = (string) file_get_contents(__DIR__ . '/../../fixtures/json/callback_request_status.json');
        $requestStatus = CallbackSerializer::deserializeRequestStatus($data);

        $this->assertEquals('2024/12345', $requestStatus->getRequestIdentifier());
        $this->assertEquals('abcd', $requestStatus->getCorrelationId());
        $this->assertEquals('COMP', $requestStatus->getStatus());
        $this->assertEquals(new \DateTime('2024-02-28T12:03:03.6239422'), $requestStatus->getDate());
    }

    /**
     * @covers \OpenEuropa\CdtClient\Serializer\CallbackSerializer
     */
    public function testJobStatus(): void
    {
        $data = (string) file_get_contents(__DIR__ . '/../../fixtures/json/callback_job_status.json');
        $jobStatus = CallbackSerializer::deserializeJobStatus($data);

        $this->assertEquals('2024/12345', $jobStatus->getRequestIdentifier());
        $this->assertEquals('CMP', $jobStatus->getStatus());
        $this->assertEquals('test.xml', $jobStatus->getSourceDocumentName());
        $this->assertEquals('EN', $jobStatus->getSourceLanguageCode());
        $this->assertEquals('FR', $jobStatus->getTargetLanguageCode());
    }

    /**
     * @covers \OpenEuropa\CdtClient\Serializer\CallbackSerializer
     */
    public function testRequestUpdate(): void
    {
        $data = (string) file_get_contents(__DIR__ . '/../../fixtures/json/callback_request_update.json');
        $requestUpdate = CallbackSerializer::deserializeRequestUpdate($data);

        $this->assertEquals('2024/12345', $requestUpdate->getRequestIdentifier());
        $this->assertEquals('abcdef', $requestUpdate->getRequestId());
        $this->assertEquals('ghijkl', $requestUpdate->getJobId());
        $this->assertEquals('EN', $requestUpdate->getSourceLanguage());
        $this->assertEquals('FR', $requestUpdate->getTargetLanguage());
        $this->assertEquals('test.xml', $requestUpdate->getDocumentName());
        $this->assertEquals('PRICE', $requestUpdate->getUpdateType());
        $this->assertEquals(['Example' => 0.05], $requestUpdate->getPropertiesChanges());
    }
}
