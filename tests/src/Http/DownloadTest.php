<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Http;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Http\Download;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Model\Response\ValidationErrors;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Http\Download
 */
class DownloadTest extends TestCase
{
    use ClientTestTrait;
    use AssertTestRequestTrait;
    use ResponseModelTestTrait;

    /**
     * @dataProvider providerTestFile
     *
     * @param Response[] $responses
     *
     * @covers \OpenEuropa\CdtClient\Http\Download
     */
    public function testFile(string $fileUrl, array $responses, mixed $expectedResult): void
    {
        $token = (new Token())->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $apiFactory = $this->getTestingApiFactory([], $responses);
        $apiFactory->setToken($token);
        $download = $apiFactory->createDownload();
        assert($download instanceof Download);

        try {
            $result = $download->downloadFile($fileUrl);
        } catch (ValidationErrorsException $e) {
            $result = $e->getValidationErrors();
        }

        $this->assertEquals($expectedResult, $result);
        $this->assertCount(1, $this->clientHistory);
        $request = $this->clientHistory[0]['request'];
        $this->assertAuthorizationHeaders($request);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function providerTestFile(): array
    {
        return [
            'valid file call' => [
                'https://example.com/v2/files/12345678-90ab-cdef-1234-567890abcdef',
                [
                    new Response(200, [], 'Test file content'),
                ],
                'Test file content'
            ],
            'failed file call' => [
                'https://example.com/v2/files/12345678-90ab-cdef-1234-567890abc123',
                [
                    new Response(400, [], (string) file_get_contents(__DIR__ . '/../../fixtures/json/file_error_response.json')),
                ],
                (new ValidationErrors())
                    ->setMessage('The file link with id 12345678-90ab-cdef-1234-567890abc123 was not found or it has expired'),
            ]
        ];
    }
}
