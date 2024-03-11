<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\Callback\JobStatus;
use OpenEuropa\CdtClient\Model\Callback\RequestStatus;
use OpenEuropa\CdtClient\Model\Callback\RequestUpdate;

/**
 * Trait CallbackModelTestTrait
 *
 * Provides helper methods for testing classes that utilize the callback data models.
 */
trait CallbackModelTestTrait
{
    /**
     * @param array<string, mixed> $data
     */
    public function createCallbackJobStatus(array $data = []): JobStatus
    {
        return (new JobStatus())
            ->setRequestIdentifier($data['requestIdentifier'] ?? '2024/12345')
            ->setStatus($data['status'] ?? 'CMP')
            ->setSourceDocumentName($data['sourceDocumentName'] ?? 'file.xml')
            ->setSourceLanguageCode($data['sourceLanguageCode'] ?? 'EN')
            ->setTargetLanguageCode($data['targetLanguageCode'] ?? 'FR');
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createCallbackRequestStatus(array $data = []): RequestStatus
    {
        return (new RequestStatus())
            ->setRequestIdentifier($data['requestIdentifier'] ?? '2024/12345')
            ->setStatus($data['status'] ?? 'COMP')
            ->setDate($data['date'] ?? new \DateTime())
            ->setCorrelationId($data['correlationId'] ?? '12345');
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createCallbackRequestUpdate(array $data = []): RequestUpdate
    {
        return (new RequestUpdate())
            ->setRequestIdentifier($data['requestIdentifier'] ?? '2024/12345')
            ->setRequestId($data['requestId'] ?? '12345')
            ->setJobId($data['jobId'] ?? '12345')
            ->setSourceLanguage($data['sourceLanguage'] ?? 'EN')
            ->setTargetLanguage($data['targetLanguage'] ?? 'FR')
            ->setDocumentName($data['documentName'] ?? 'file.xml')
            ->setUpdateType($data['updateType'] ?? 'PRICE')
            ->setPropertiesChanges($data['propertiesChanges'] ?? []);
    }
}
