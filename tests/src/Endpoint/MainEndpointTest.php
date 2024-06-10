<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Endpoint\MainEndpoint;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ApiTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\MainEndpoint
 */
class MainEndpointTest extends TestCase
{
    use ApiTestTrait;
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
        $mainEndpoint = new MainEndpoint($this->getTestingRest($responses), $clientConfig, $this->getTestingToken());
        $this->assertEquals($expectedResult, $mainEndpoint->isConnected());
        $this->assertCount(1, $this->clientHistory);
        $request = $this->clientHistory[0]['request'];
        $this->assertMainRequest($request);
        $this->assertAuthorizationHeaders($request);
    }

    /**
     * @see self::testMain()
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
                    new Response(200, [], 'true'),
                ],
                true,
            ],
            'failed' => [
                [
                    'apiBaseUrl' => 'https://example.com',
                ],
                [
                    new Response(200, [], 'false'),
                ],
                false,
            ],
        ];
    }
}
