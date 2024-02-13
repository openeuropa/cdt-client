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
     * @dataProvider providerTestCheckConection
     *
     * @param array $clientConfig
     * @param array $responses
     * @param mixed $expectedResult
     */
    public function testCheckConnection(array $clientConfig, array $responses, $expectedResult): void
    {
        $token = (new Token())->setAccessToken('testtoekn')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $actualResult = $this->getTestingClient($clientConfig, $responses)->setToken($token)->checkConnection();
        $this->assertEquals($expectedResult, $actualResult);
        $this->assertCount(1, $this->clientHistory);
        $request = $this->clientHistory[0]['request'];
        $this->assertEquals('https://example.com/v2/CheckConnection', $request->getUri());
    }

    /**
     * @see self::testCheckConnection()
     */
    public static function providerTestCheckConection(): array
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
            'falied' => [
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
