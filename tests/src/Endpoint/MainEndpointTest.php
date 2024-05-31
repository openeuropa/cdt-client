<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Endpoint\MainEndpoint;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\MainEndpoint
 */
class MainEndpointTest extends TestCase
{
    use ClientTestTrait;
    use AssertTestRequestTrait;

    /**
     * @dataProvider providerTestMain
     *
     * @param array<string, mixed> $clientConfig
     * @param Response[] $responses
     * @param mixed $expectedResult
     *
     * @covers \OpenEuropa\CdtClient\Endpoint\MainEndpoint
     * @covers \OpenEuropa\CdtClient\Endpoint\EndpointBase
     * @covers \OpenEuropa\CdtClient\Http\Rest
     */
    public function testMain(array $clientConfig, array $responses, mixed $expectedResult): void
    {
        $token = (new Token())->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $apiFactory = $this->getTestingApiFactory($clientConfig, $responses);
        $apiFactory->setToken($token);
        $mainEndpoint = $apiFactory->createEndpoint(MainEndpoint::class);
        assert($mainEndpoint instanceof MainEndpoint);
        $this->assertEquals($expectedResult, $mainEndpoint->isConnected());
        $this->assertCount(1, $this->clientHistory);
        $request = $this->clientHistory[0]['request'];
        $this->assertMainRequest($request);
        $this->assertAuthorizationHeaders($request);
    }

    /**
     * @see self::testCheckConnection()
     *
     * @return array<string, array<int, mixed>>
     */
    public static function providerTestMain(): array
    {
        return [
            'connected' => [
                [
                    'apiBaseUrl' => 'https://example.com',
                ],
                [
                    new Response(200, [], 'true')
                ],
                true,
            ],
            'failed' => [
                [
                    'apiBaseUrl' => 'https://example.com',
                ],
                [
                    new Response(200, [], 'false')
                ],
                false,
            ]
        ];
    }
}
