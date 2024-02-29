<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Model\Response\ReferenceContact;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Model\Response\ReferenceItem;
use OpenEuropa\CdtClient\Model\Token;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\ReferenceDataEndpoint
 */
class ReferenceDataEndpointTest extends TestCase
{
    use ClientTestTrait;
    use AssertTestRequestTrait;
    use ResponseModelTestTrait;

    /**
     * @dataProvider providerTestReferenceData
     *
     * @param array<string, mixed> $clientConfig
     * @param Response[] $responses
     * @param mixed $expectedResult
     *
     * @covers ::execute
     * @covers ::setToken
     * @covers ::getToken
     * @covers ::getRequestHeaders
     */
    public function testReferenceData(array $clientConfig, array $responses, mixed $expectedResult): void
    {
        $token = (new Token())->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $client = $this->getTestingClient($clientConfig, $responses);
        $container = $this->getClientContainer($client);
        $referenceDataEndpoint = $container->get('referenceData');
        $referenceDataEndpoint->setToken($token);
        $this->assertEquals($token, $referenceDataEndpoint->getToken());
        $this->assertEquals($this->createResponseReferenceData($expectedResult), $referenceDataEndpoint->execute());
        $this->assertCount(1, $this->clientHistory);
        $request = $this->clientHistory[0]['request'];
        $this->assertReferenceDataRequest($request);
        $this->assertAuthorizationHeaders($request);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function providerTestReferenceData(): array
    {
        return [
            'simple reference data call' => [
                [
                    'referenceDataApiEndpoint' => 'https://example.com/v2/requests/businessReferenceData',
                ],
                [
                    new Response(200, [], (string) file_get_contents(__DIR__ . '/../../fixtures/json/reference_data_response.json'))
                ],
                [
                    'departments' => [
                        ['code' => '250771', 'description' => 'External Translation Unit - Contracts Execution Department'],
                        ['code' => '250772', 'description' => 'Service Finance'],
                    ],
                    'priorities' => [
                        ['code' => 'SL', 'description' => 'Slow'],
                        ['code' => 'NO', 'description' => 'Normal'],
                        ['code' => 'TU', 'description' => 'Urgent'],
                        ['code' => 'VU', 'description' => 'Very Urgent'],
                    ],
                    'purposes' => [
                        ['code' => 'BF', 'description' => 'Budget / Financial text'],
                        ['code' => 'PC', 'description' => 'Podcasts'],
                    ],
                    'deliveryModes' => [
                        ['code' => 'No', 'description' => 'No'],
                        ['code' => 'YesMF', 'description' => 'Yes(Multiple Files)'],
                        ['code' => 'YesSF', 'description' => 'Yes(Single File)'],
                    ],
                    'confidentialities' => [
                        ['code' => 'NO', 'description' => 'None'],
                        ['code' => 'SN', 'description' => 'Sensitive non-classified – with retention'],
                        ['code' => 'SR', 'description' => 'Sensitive non-classified – without retention'],
                        ['code' => 'SC', 'description' => 'Classified'],
                    ],
                    'languages' => ['AR', 'AZ', 'BE', 'BG', 'BN', 'BS'],
                    'statuses' => [
                        ['code' => 'DRAF', 'description' => 'Draft'],
                        ['code' => 'MTS', 'description' => 'Marked to Send'],
                        ['code' => 'PEND', 'description' => 'Quoted - Pending Approval'],
                    ],
                    'services' => [
                        ['code' => 'Editing', 'description' => 'Editing'],
                        ['code' => 'LightPostEditing', 'description' => 'Light post-editing'],
                    ],
                    'sendOptions' => [
                        ['code' => 'MarkToSend', 'description' => 'Mark To send'],
                        ['code' => 'Send', 'description' => 'Send'],
                        ['code' => 'SendAsDraft', 'description' => 'Send as draft'],
                    ],
                    'contacts' => [
                        [
                            'email' => 'contact@example.com',
                            'firstName' => 'John',
                            'lastName' => 'Smith',
                            'userName' => 'JohnSmith',
                            'phoneNumber' => '+353333222111',
                            'countryCode' => null,
                            'phoneCountryCode' => null,
                            'countryName' => '',
                        ],
                    ],
                ],
            ],
        ];
    }
}
