<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Endpoint\StatusEndpoint;
use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Response\ValidationErrors;
use OpenEuropa\CdtClient\Model\Token;
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
     * @dataProvider providerTestInvalidPermanentId
     *
     * @covers ::setPermanentId
     */
    public function testInvalidPermanentId(string $permanentId): void
    {
        $this->expectExceptionObject(new \InvalidArgumentException('Invalid permanent ID format (it should be formatted like 2024/1234567).'));
        $fileEndpoint = new StatusEndpoint('https://example.com/v2/requests/:requestyear/:requestnumber/targets-base64');
        $fileEndpoint->setPermanentId($permanentId);
    }

    /**
     * @dataProvider providerTestStatus
     *
     * @param array<string, mixed> $clientConfig
     * @param Response[] $responses
     *
     * @covers \OpenEuropa\CdtClient\Endpoint\FileEndpoint
     * @covers \OpenEuropa\CdtClient\Endpoint\BaseEndpoint
     */
    public function testStatus(string $permanentId, array $clientConfig, array $responses, mixed $expectedResult): void
    {
        $token = (new Token())->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $client = $this->getTestingClient($clientConfig, $responses);
        $container = $this->getClientContainer($client);
        $fileEndpoint = $container->get('file');
        $fileEndpoint->setToken($token);
        $this->assertEquals($token, $fileEndpoint->getToken());
        $fileEndpoint->setPermanentId($permanentId);
        $this->assertEquals($permanentId, $fileEndpoint->getPermanentId());

        try {
            $result = $fileEndpoint->execute();
            $this->assertEquals($this->createResponseFileList($expectedResult), $result);
        } catch (ValidationErrorsException $e) {
            $result = $e->getValidationErrors();
            $this->assertEquals($expectedResult, $result);
        }
        $this->assertCount(1, $this->clientHistory);
        $request = $this->clientHistory[0]['request'];
        $this->assertFileRequest($request, $permanentId);
        $this->assertAuthorizationHeaders($request);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function providerTestStatus(): array
    {
        return [
            'valid status call' => [
                '2024/12345',
                [
                    'fileApiEndpoint' => 'https://example.com/v2/requests/:requestyear/:requestnumber/targets-base64',
                ],
                [
                    new Response(200, [], (string) file_get_contents(__DIR__ . '/../../fixtures/json/file_valid_response.json'))
                ],
                [
                    [
                        'content' => 'Some Test Content',
                        'sourceLanguage' => 'FR',
                        'targetLanguage' => 'PL',
                        'sourceDocument' => 'source1.txt',
                        'fileName' => 'target1.txt',
                        'isPrivate' => false,
                        'links' => [
                            'files' => [
                                'href' => 'https://example.com/v2/files/12345678-90ab-cdef-1234-567890abcdef',
                                'method' => 'GET'
                            ]
                        ],
                    ],
                    [
                        'content' => 'Some Other Test Content',
                        'sourceLanguage' => 'NL',
                        'targetLanguage' => 'DE',
                        'sourceDocument' => 'source2.txt',
                        'fileName' => 'target2.txt',
                        'isPrivate' => true,
                        'links' => [
                            'files' => [
                                'href' => 'https://example.com/v2/files/12345678-90ab-cdef-1234-567890abcdef',
                                'method' => 'GET'
                            ]
                        ],
                    ]
                ],
            ],
            'failed file call' => [
                '2024/12346',
                [
                    'fileApiEndpoint' => 'https://example.com/v2/requests/:requestyear/:requestnumber/targets-base64',
                ],
                [
                    new Response(400, [], (string) file_get_contents(__DIR__ . '/../../fixtures/json/file_error_response.json'))
                ],
                (new ValidationErrors())
                    ->setMessage('The request does not exists.')
                    ->setErrors([])
            ]
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function providerTestInvalidPermanentId(): array
    {
        return [
            'no separator' => [
                '202422223',
            ],
            'too many separators' => [
                '2024/222/23',
            ],
            'year too short' => [
                '202/222231',
            ],
            'year with chars' => [
                '202a/222231',
            ],
        ];
    }
}
