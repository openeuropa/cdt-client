<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Traits;

use OpenEuropa\CdtClient\Model\Request\Callback;
use OpenEuropa\CdtClient\Model\Request\CallbackCollection;
use OpenEuropa\CdtClient\Model\Request\File;
use OpenEuropa\CdtClient\Model\Request\ReferenceFile;
use OpenEuropa\CdtClient\Model\Request\ReferenceFileCollection;
use OpenEuropa\CdtClient\Model\Request\ReferenceUrl;
use OpenEuropa\CdtClient\Model\Request\ReferenceUrlCollection;
use OpenEuropa\CdtClient\Model\Request\SourceDocument;
use OpenEuropa\CdtClient\Model\Request\SourceDocumentCollection;
use OpenEuropa\CdtClient\Model\Request\Translation;
use OpenEuropa\CdtClient\Model\Request\TranslationJob;
use OpenEuropa\CdtClient\Model\Request\TranslationJobCollection;

/**
 * Trait ModelTestTrait
 *
 * Provides helper methods for testing classes that utilize the data models.
 */
trait ModelTestTrait
{
    /**
     * Creates a File request object.
     *
     * @param array<string, mixed> $data
     */
    public function createRequestFile(array $data = []): File
    {
        return (new File())
            ->setFilename($data['filename'] ?? 'test.txt')
            ->setBase64Data(base64_encode($data['content'] ?? 'Test content'));
    }

    /**
     * Creates a ReferenceFile request object.
     *
     * @param array<string, mixed> $data
     */
    public function createRequestReferenceFile(array $data = []): ReferenceFile
    {
        return (new ReferenceFile())
            ->setFile($data['file'] ?? $this->createRequestFile())
            ->setReferenceLanguages($data['referenceLanguages'] ?? ['en']);
    }

    /**
     * Creates a ReferenceUrl request object.
     *
     * @param array<string, mixed> $data
     */
    public function createRequestReferenceUrl(array $data = []): ReferenceUrl
    {
        return (new ReferenceUrl())
            ->setUrl($data['url'] ?? 'https://example.com')
            ->setReferenceLanguages($data['referenceLanguages'] ?? ['en'])
            ->setShortName($data['shortName'] ?? 'Example');
    }

    /**
     * Creates a SourceDocument request object.
     *
     * @param array<string, mixed> $data
     */
    public function createRequestSourceDocument(array $data = []): SourceDocument
    {
        return (new SourceDocument())
            ->setFile($data['file'] ?? $this->createRequestFile())
            ->setSourceLanguages($data['sourceLanguages'] ?? ['en'])
            ->setOutputDocumentFormatCode($data['outputDocumentFormatCode'] ?? 'XM')
            ->setTranslationJobs(new TranslationJobCollection($data['translationJobs'] ?? [$this->createRequestTranslationJob()]))
            ->setConfidentialityCode($data['confidentialityCode'] ?? 'N')
            ->setIsPrivate($data['isPrivate'] ?? false);
    }

    /**
     * Creates a TranslationJob request object.
     *
     * @param array<string, mixed> $data
     */
    public function createRequestTranslationJob(array $data = []): TranslationJob
    {
        return (new TranslationJob())
            ->setSourceLanguage($data['sourceLanguage'] ?? 'en')
            ->setTargetLanguage($data['targetLanguage'] ?? 'fr')
            ->setVolume($data['volume'] ?? 0.5);
    }

    /**
     * Creates a Callback request object.
     *
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
     * Creates a Translation request object.
     *
     * @param array<string, mixed> $data
     */
    public function createRequestTranslation(array $data = []): Translation
    {
        return (new Translation())
            ->setDepartmentCode($data['departmentCode'] ?? '123')
            ->setContactUserNames($data['contactUserNames'] ?? ['TESTUSER'])
            ->setDeliveryContactUsernames($data['deliveryContactUsernames'] ?? ['TESTUSER'])
            ->setPhoneNumber($data['phoneNumber'] ?? '123456789')
            ->setTitle($data['title'] ?? 'Test Title')
            ->setClientReference($data['clientReference'] ?? '1')
            ->setPurposeCode($data['purposeCode'] ?? 'PC')
            ->setPriorityCode($data['priorityCode'] ?? 'SL')
            ->setComments($data['comments'] ?? 'Test Comments')
            ->setReferenceSetUrls(new ReferenceUrlCollection($data['referenceSetUrls'] ?? [$this->createRequestReferenceUrl()]))
            ->setReferenceSetFiles(new ReferenceFileCollection($data['referenceSetFiles'] ?? [$this->createRequestReferenceFile()]))
            ->setSourceDocuments(new SourceDocumentCollection($data['sourceDocuments'] ?? [$this->createRequestSourceDocument()]))
            ->setSendOptions($data['sendOptions'] ?? 'Send')
            ->setService($data['service'] ?? 'Translation')
            ->setIsQuotationOnly($data['isQuotationOnly'] ?? false)
            ->setCallbacks(new CallbackCollection($data['callbacks'] ?? [$this->createRequestCallback()]));
    }
}
