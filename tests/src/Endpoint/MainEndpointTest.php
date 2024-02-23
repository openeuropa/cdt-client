<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Model\Token;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
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
     * @covers ::__construct
     * @covers ::execute
     * @covers ::setToken
     * @covers ::getToken
     * @covers ::getRequestHeaders
     */
    public function testMain(array $clientConfig, array $responses, $expectedResult): void
    {
        $token = (new Token())->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $client = $this->getTestingClient($clientConfig, $responses);
        $container = $this->getClientContainer($client);
        $mainEndpoint = $container->get('main');
        $this->assertEquals($expectedResult, $mainEndpoint->setToken($token)->execute());
        $this->assertEquals($token, $mainEndpoint->getToken());
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
                    'mainApiEndpoint' => 'https://example.com/v2/CheckConnection',
                ],
                [
                    new Response(200, [], 'true')
                ],
                true,
            ],
            'failed' => [
                [
                    'mainApiEndpoint' => 'https://example.com/v2/CheckConnection',
                ],
                [
                    new Response(200, [], 'false')
                ],
                false,
            ]
        ];
    }
}
