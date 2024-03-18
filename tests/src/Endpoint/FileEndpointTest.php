<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Model\Response\ValidationErrors;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\FileEndpoint
 */
class FileEndpointTest extends TestCase
{
    use ClientTestTrait;
    use AssertTestRequestTrait;
    use ResponseModelTestTrait;

    /**
     * @dataProvider providerTestFile
     *
     * @param Response[] $responses
     *
     * @covers \OpenEuropa\CdtClient\Endpoint\FileEndpoint
     * @covers \OpenEuropa\CdtClient\Endpoint\EndpointBase
     */
    public function testFile(string $fileUrl, array $responses, mixed $expectedResult): void
    {
        $token = (new Token())->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $client = $this->getTestingClient([], $responses);
        $container = $this->getClientContainer($client);
        $fileEndpoint = $container->get('file');
        $fileEndpoint->setToken($token);
        $this->assertEquals($token, $fileEndpoint->getToken());
        $fileEndpoint->setFileUrl($fileUrl);
        $this->assertEquals($fileUrl, $fileEndpoint->getFileUrl());

        try {
            $result = $fileEndpoint->execute();
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
