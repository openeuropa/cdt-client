<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Model\Response\ReferenceContact;
use OpenEuropa\CdtClient\Model\Response\ReferenceData;
use OpenEuropa\CdtClient\Model\Response\ReferenceItem;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\ReferenceDataEndpoint
 */
class ReferenceDataEndpointTest extends TestCase
{
    use ClientTestTrait;
    use AssertTestRequestTrait;

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
        $this->assertEquals($expectedResult, $referenceDataEndpoint->setToken($token)->execute());
        $this->assertEquals($token, $referenceDataEndpoint->getToken());
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
                (new ReferenceData())
                    ->setDepartments([
                        (new ReferenceItem())->setCode('250771')->setDescription('External Translation Unit - Contracts Execution Department'),
                        (new ReferenceItem())->setCode('250772')->setDescription('Service Finance'),
                    ])
                    ->setPriorities([
                        (new ReferenceItem())->setCode('SL')->setDescription('Slow'),
                        (new ReferenceItem())->setCode('NO')->setDescription('Normal'),
                        (new ReferenceItem())->setCode('TU')->setDescription('Urgent'),
                        (new ReferenceItem())->setCode('VU')->setDescription('Very Urgent'),
                    ])
                    ->setPurposes([
                        (new ReferenceItem())->setCode('BF')->setDescription('Budget / Financial text'),
                        (new ReferenceItem())->setCode('PC')->setDescription('Podcasts'),
                    ])
                    ->setDeliveryModes([
                        (new ReferenceItem())->setCode('No')->setDescription('No'),
                        (new ReferenceItem())->setCode('YesMF')->setDescription('Yes(Multiple Files)'),
                        (new ReferenceItem())->setCode('YesSF')->setDescription('Yes(Single File)'),
                    ])
                    ->setConfidentialities([
                        (new ReferenceItem())->setCode('NO')->setDescription('None'),
                        (new ReferenceItem())->setCode('SN')->setDescription('Sensitive non-classified – with retention'),
                        (new ReferenceItem())->setCode('SR')->setDescription('Sensitive non-classified – without retention'),
                        (new ReferenceItem())->setCode('SC')->setDescription('Classified'),
                    ])
                    ->setLanguages([
                        "AR",
                        "AZ",
                        "BE",
                        "BG",
                        "BN",
                        "BS",
                    ])
                    ->setStatuses([
                        (new ReferenceItem())->setCode('DRAF')->setDescription('Draft'),
                        (new ReferenceItem())->setCode('MTS')->setDescription('Marked to Send'),
                        (new ReferenceItem())->setCode('PEND')->setDescription('Quoted - Pending Approval'),
                    ])
                    ->setServices([
                        (new ReferenceItem())->setCode('Editing')->setDescription('Editing'),
                        (new ReferenceItem())->setCode('LightPostEditing')->setDescription('Light post-editing'),
                    ])
                    ->setSendOptions([
                        (new ReferenceItem())->setCode('MarkToSend')->setDescription('Mark To send'),
                        (new ReferenceItem())->setCode('Send')->setDescription('Send'),
                        (new ReferenceItem())->setCode('SendAsDraft')->setDescription('Send as draft'),
                    ])
                    ->setContacts([
                        (new ReferenceContact())
                            ->setEmail('contact@example.com')
                            ->setFirstName('John')
                            ->setLastName('Smith')
                            ->setUserName('JohnSmith')
                            ->setPhoneNumber('+353333222111')
                            ->setCountryCode(null)
                            ->setPhoneCountryCode(null)
                            ->setCountryName('')
                    ])

            ],
        ];
    }
}
