<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Contract\ApiFactoryInterface;
use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Model\Response\Translation;
use OpenEuropa\Tests\CdtClient\Traits\ApiTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\ApiClient
 */
class ApiClientTest extends TestCase
{
    use ApiTestTrait;
    use RequestModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\ApiClient
     * @covers \OpenEuropa\CdtClient\ApiFactory::setToken
     */
    public function testTokenSetter(): void
    {
        $client = $this->getTestingApiClient();

        $token = new Token();
        $token->setAccessToken('testtoken');
        $client->setToken($token);

        // Use reflection to access the protected property.
        $apiClientReflection = new \ReflectionClass($client);
        $apiFactoryProperty = $apiClientReflection->getProperty('apiFactory');
        $apiFactory = $apiFactoryProperty->getValue($client);
        assert($apiFactory instanceof ApiFactoryInterface);

        $apiFactoryReflection = new \ReflectionClass($apiFactory);
        $tokenProperty = $apiFactoryReflection->getProperty('token');
        $actualToken = $tokenProperty->getValue($apiFactory);
        self::assertEquals($token, $actualToken);
    }

    /**
     * @covers ::requestToken
     */
    public function testRequestToken(): void
    {
        $responses = [
            new Response(200, [], (string) file_get_contents(__DIR__ . '/../fixtures/json/simple_token_call_response.json')),
        ];
        $client = $this->getTestingApiClient([], $responses, false);
        self::assertInstanceOf(Token::class, $client->requestToken());
    }

    /**
     * @covers ::getReferenceData
     */
    public function testGetReferenceData(): void
    {
        $responses = [
            new Response(200, [], (string) file_get_contents(__DIR__ . '/../fixtures/json/reference_data_response.json'))
        ];
        $client = $this->getTestingApiClient([], $responses);
        $this->assertInstanceOf(ReferenceData::class, $client->getReferenceData());
    }

    /**
     * @covers ::checkConnection
     */
    public function testCheckConnection(): void
    {
        $responses = [
            new Response(200, [], 'true'),
        ];
        $client = $this->getTestingApiClient([], $responses);
        self::assertTrue($client->checkConnection());
    }

    /**
     * @covers ::validateTranslationRequest
     */
    public function testFailedValidateTranslationRequest(): void
    {
        $responses = [
            new Response(400, [], (string) file_get_contents(__DIR__ . '/../fixtures/json/validate_error_response.json'))
        ];
        $client = $this->getTestingApiClient([], $responses);
        $this->expectException(ValidationErrorsException::class);
        $request = $this->createRequestTranslation();
        $client->validateTranslationRequest($request);
    }

    /**
     * @covers ::validateTranslationRequest
     */
    public function testSuccessfulValidateTranslationRequest(): void
    {
        $responses = [
            new Response(200, [], 'true')
        ];
        $client = $this->getTestingApiClient([], $responses);
        $request = $this->createRequestTranslation();
        self::assertTrue($client->validateTranslationRequest($request));
    }

    /**
     * @covers ::sendTranslationRequest
     */
    public function testSendTranslationRequest(): void
    {
        $responses = [
            new Response(200, [], '123')
        ];
        $client = $this->getTestingApiClient([], $responses);
        $request = $this->createRequestTranslation();
        self::assertEquals('123', $client->sendTranslationRequest($request));
    }

    /**
     * @covers ::getPermanentIdentifier
     */
    public function testGetPermanentIdentifier(): void
    {
        $responses = [
            new Response(200, [], '2024/123')
        ];
        $client = $this->getTestingApiClient([], $responses);
        self::assertEquals('2024/123', $client->getPermanentIdentifier('123'));
    }

    /**
     * @covers ::getRequestStatus
     */
    public function testGetRequestStatus(): void
    {
        $responses = [
            new Response(200, [], (string) file_get_contents(__DIR__ . '/../fixtures/json/status_valid_response.json'))
        ];
        $client = $this->getTestingApiClient([], $responses);
        self::assertInstanceOf(Translation::class, $client->getRequestStatus('2024/123'));
    }

    /**
     * @covers ::downloadFile
     */
    public function testDownloadFile(): void
    {
        $responses = [
            new Response(200, [], 'TEST FILE CONTENT')
        ];
        $client = $this->getTestingApiClient([], $responses);
        self::assertEquals('TEST FILE CONTENT', $client->downloadFile('https://example.com/file.txt'));
    }
}
