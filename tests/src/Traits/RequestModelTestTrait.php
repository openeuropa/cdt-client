<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\Request\Callback;
use OpenEuropa\CdtClient\Model\Request\File;
use OpenEuropa\CdtClient\Model\Request\ReferenceFile;
use OpenEuropa\CdtClient\Model\Request\ReferenceUrl;
use OpenEuropa\CdtClient\Model\Request\SourceDocument;
use OpenEuropa\CdtClient\Model\Request\Translation;
use OpenEuropa\CdtClient\Model\Request\TranslationJob;

/**
 * Trait RequestModelTestTrait
 *
 * Provides helper methods for testing classes that utilize the request data models.
 */
trait RequestModelTestTrait
{
    /**
     * @param array<string, mixed> $data
     */
    public function createRequestFile(array $data = []): File
    {
        return (new File())
            ->setFilename($data['filename'] ?? 'test.xml')
            ->setContent($data['content'] ?? '<?xml version="1.0" encoding="UTF-8" standalone="no"?>');
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createRequestReferenceFile(array $data = []): ReferenceFile
    {
        return (new ReferenceFile())
            ->setFile($data['file'] ?? $this->createRequestFile())
            ->setReferenceLanguages($data['referenceLanguages'] ?? ['EN']);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createRequestReferenceUrl(array $data = []): ReferenceUrl
    {
        return (new ReferenceUrl())
            ->setUrl($data['url'] ?? 'https://example.com')
            ->setReferenceLanguages($data['referenceLanguages'] ?? ['EN'])
            ->setShortName($data['shortName'] ?? 'Example');
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createRequestSourceDocument(array $data = []): SourceDocument
    {
        return (new SourceDocument())
            ->setFile($data['file'] ?? $this->createRequestFile())
            ->setSourceLanguages($data['sourceLanguages'] ?? ['EN'])
            ->setOutputDocumentFormatCode($data['outputDocumentFormatCode'] ?? 'XM')
            ->setTranslationJobs($this->createRequestObjectList(
                $data['translationJobs'] ?? [],
                [$this, 'createRequestTranslationJob']
            ))
            ->setConfidentialityCode($data['confidentialityCode'] ?? 'NO')
            ->setIsPrivate($data['isPrivate'] ?? false);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createRequestTranslationJob(array $data = []): TranslationJob
    {
        return (new TranslationJob())
            ->setSourceLanguage($data['sourceLanguage'] ?? 'EN')
            ->setTargetLanguage($data['targetLanguage'] ?? 'FR')
            ->setVolume($data['volume'] ?? 0.5);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createRequestCallback(array $data = []): Callback
    {
        return (new Callback())
            ->setCallbackType($data['callbackType'] ?? 'REQUEST_STATUS')
            ->setCallbackBaseUrl($data['callbackBaseUrl'] ?? 'http://example.com/callback')
            ->setClientApiKey($data['clientApiKey'] ?? '123');
    }

    /**
     * @param array<string, mixed> $data
     */
    public function createRequestTranslation(array $data = []): Translation
    {
        return (new Translation())
            ->setDepartmentCode($data['departmentCode'] ?? '250771')
            ->setContactUserNames($data['contactUserNames'] ?? ['DGTRADETUCE'])
            ->setDeliveryContactUsernames($data['deliveryContactUsernames'] ?? ['DGTRADETUCE'])
            ->setPhoneNumber($data['phoneNumber'] ?? '123456789')
            ->setTitle($data['title'] ?? 'Test Title')
            ->setClientReference($data['clientReference'] ?? '1')
            ->setPurposeCode($data['purposeCode'] ?? 'PC')
            ->setDeliveryModeCode($data['deliveryModeCode'] ?? 'YesSF')
            ->setPriorityCode($data['priorityCode'] ?? 'SL')
            ->setComments($data['comments'] ?? 'Test Comments')
            ->setReferenceSetUrls($this->createRequestObjectList(
                $data['referenceSetUrls'] ?? [],
                [$this, 'createRequestReferenceUrl']
            ))
            ->setReferenceSetFiles($this->createRequestObjectList(
                $data['referenceSetFiles'] ?? [],
                [$this, 'createRequestReferenceFile']
            ))
            ->setSourceDocuments($this->createRequestObjectList(
                $data['sourceDocuments'] ?? [],
                [$this, 'createRequestSourceDocument']
            ))
            ->setSendOptions($data['sendOptions'] ?? 'Send')
            ->setService($data['service'] ?? 'Translation')
            ->setIsQuotationOnly($data['isQuotationOnly'] ?? false)
            ->setCallbacks($this->createRequestObjectList(
                $data['callbacks'] ?? [],
                [$this, 'createRequestCallback']
            ));
    }

    /**
     * @param array<int, mixed> $items
     * @return array<int, mixed>
     */
    public function createRequestObjectList(array $items, callable $callback): array
    {
        if (!empty($items)) {
            $objects = [];
            foreach ($items as $item) {
                $objects[] = $callback($item);
            }
        } else {
            $objects = [$callback([])];
        }
        return $objects;
    }
}
