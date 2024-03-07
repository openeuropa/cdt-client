<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Endpoint\StatusEndpoint;
use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Model\Response\ValidationErrors;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\StatusEndpoint
 */
class StatusEndpointTest extends TestCase
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
        $statusEndpoint = new StatusEndpoint('https://example.com/v2/requests/:requestyear/:requestnumber');
        $statusEndpoint->setPermanentId($permanentId);
    }

    /**
     * @dataProvider providerTestStatus
     *
     * @param array<string, mixed> $clientConfig
     * @param Response[] $responses
     *
     * @covers \OpenEuropa\CdtClient\Endpoint\StatusEndpoint
     * @covers \OpenEuropa\CdtClient\Endpoint\BaseEndpoint
     */
    public function testStatus(string $permanentId, array $clientConfig, array $responses, mixed $expectedResult): void
    {
        $token = (new Token())->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $client = $this->getTestingClient($clientConfig, $responses);
        $container = $this->getClientContainer($client);
        $statusEndpoint = $container->get('status');
        $statusEndpoint->setToken($token);
        $this->assertEquals($token, $statusEndpoint->getToken());
        $statusEndpoint->setPermanentId($permanentId);
        $this->assertEquals($permanentId, $statusEndpoint->getPermanentId());

        try {
            $result = $statusEndpoint->execute();
            $this->assertEquals($this->createResponseTranslation($expectedResult), $result);
        } catch (ValidationErrorsException $e) {
            $result = $e->getValidationErrors();
            $this->assertEquals($expectedResult, $result);
        }
        $this->assertCount(1, $this->clientHistory);
        $request = $this->clientHistory[0]['request'];
        $this->assertStatusRequest($request, $permanentId);
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
                    'statusApiEndpoint' => 'https://example.com/v2/requests/:requestyear/:requestnumber',
                ],
                [
                    new Response(200, [], (string) file_get_contents(__DIR__ . '/../../fixtures/json/status_valid_response.json'))
                ],
                [
                    'requestIdentifier' => '2024/000001',
                    'status' => 'UNDE',
                    'sourceLanguages' => ['EN'],
                    'targetLanguages' => ['FR'],
                    'creationDate' => new \DateTime('2024-02-29T12:03:03.6239422'),
                    'deliveryDate' => null,
                    'title' => 'Test Title',
                    'service' => 'Translation',
                    'department' => 'External Translation Unit - Contracts Execution Department',
                    'contacts' => ['DGTRAD - Ext. Transl. Unit  Contracts Execution Dept.'],
                    'deliverToContacts' => ['DGTRAD - Ext. Transl. Unit  Contracts Execution Dept.'],
                    'sourceDocuments' => [
                        [
                            'fileName' => 'test.xml',
                            'isPrivate' => false,
                            'links' => [
                                'files' => [
                                    'href' => 'https://example.com/v2/files/12345678-90ab-cdef-1234-567890abcdef',
                                    'method' => 'GET'
                                ]
                            ],
                        ],
                    ],
                    'referenceFiles' => [
                        [
                            'languages' => ['EN'],
                            'fileName' => 'test.xml',
                            'isPrivate' => false,
                            'links' => [
                                'files' => [
                                    'href' => 'https://example.com/v2/files/12345678-90ab-cdef-1234-567890abcdef',
                                    'method' => 'GET'
                                ]
                            ],
                        ],
                    ],
                    'bilingualFiles' => [
                        [
                            'content' => '',
                            'sourceLanguage' => '',
                            'targetLanguage' => '',
                            'sourceDocument' => '',
                            'fileName' => 'bilingual.xml',
                            'isPrivate' => false,
                            'links' => [
                                'files' => [
                                    'href' => 'https://example.com/v2/files/12345678-90ab-cdef-1234-567890abcdef',
                                    'method' => 'GET'
                                ]
                            ],
                        ],
                    ],
                    'targetFiles' => [],
                    'dates' => [
                        [
                            'label' => 'Deadline',
                            'date' => new \DateTime('2024-03-07T16:00:00+01:00'),
                            'ecdtDateType' => 'Deadline',
                            'tooltip' => '',
                        ],
                        [
                            'label' => 'Receipt date',
                            'date' => new \DateTime('2024-02-28T13:03:03.4248457+01:00'),
                            'ecdtDateType' => 'ReceiptDate',
                            'tooltip' => 'The receipt date depends on the date and time of request submission. Therefore, it is only displayed if the request is pre-approved.',
                        ],
                    ],
                    'comments' => [
                        [
                            'comment' => 'Test Comments',
                            'isHTML' => false,
                            'from' => 'Client',
                        ],
                    ],
                    'totalPrice' => 0,
                    'jobSummary' => [
                        [
                            'totalPrice' => 24.5,
                            'surchargeConfidentiality' => 2.5,
                            'surchargeComplexity' => 3.0,
                            'surchargeNonEuLanguage' => 4.0,
                            'surchargeWebUpload' => 5.0,
                            'basePrice' => 0.0,
                            'volume' => 0.5,
                            'sourceLanguage' => 'DE',
                            'targetLanguage' => 'PL',
                            'fileName' => 'test1.xml',
                            'priorityCode' => 'LO',
                            'serviceVolume' => 200,
                            'serviceVolumeUnit' => 's',
                            'serviceVolumeString' => 'sentence',
                            'status' => 'INPR',
                            'isEstimatedPrice' => true,
                        ],
                    ],
                    'isInProgress' => true,
                    'clientReference' => '1',
                    'deliveryModeCode' => 'YesSF',
                    'departmentCode' => '250771',
                    'phoneNumber' => '123456789',
                    'purposeCode' => 'PC',
                    'isQuotationOnly' => false,
                    'links' => [
                        'self' => [
                            'href' => 'https://example.com/v2/files/12345678-90ab-cdef-1234-567890abcdef',
                            'method' => 'GET'
                        ]
                    ],
                ],
            ],
            'failed status call' => [
                '2024/12346',
                [
                    'statusApiEndpoint' => 'https://example.com/v2/requests/:requestyear/:requestnumber',
                ],
                [
                    new Response(400, [], (string) file_get_contents(__DIR__ . '/../../fixtures/json/status_error_response.json'))
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
