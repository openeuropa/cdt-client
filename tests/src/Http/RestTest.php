<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Http;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Exception\InvalidStatusCodeException;
use OpenEuropa\Tests\CdtClient\Traits\ApiTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Http\Rest
 */
class RestTest extends TestCase
{
    use ApiTestTrait;

    /**
     * @dataProvider providerTestRequest
     *
     * @param \GuzzleHttp\Psr7\Response[] $responses
     * @param array<string, string> $headers
     *
     * @covers ::doRequest
     */
    public function testRequest(string $method, string $url, array $responses, ?string $body, string $expectedResult, array $headers): void
    {
        if ($responses[0]->getStatusCode() !== 200) {
            $this->expectException(InvalidStatusCodeException::class);
        }

        $rest = $this->getTestingRest($responses);
        $restReflection = new \ReflectionClass($rest);
        $doRequest = $restReflection->getMethod('doRequest');
        $result = $doRequest->invoke($rest, $method, $url, $headers, $body);
        $this->assertEquals($expectedResult, $result->getBody()->__toString());
    }

    /**
     * @see self::testRequest()
     *
     * @return array<string, array<int, mixed>>
     */
    public static function providerTestRequest(): array
    {
        return [
            'valid get request without headers' => [
                'GET',
                'https://example.com/api/endpoint',
                [ new Response(200, [], 'OK') ],
                null,
                'OK',
                [],
            ],
            'invalid get request without headers' => [
                'GET',
                'https://example.com/api/endpoint',
                [ new Response(500, [], 'ERROR') ],
                null,
                'ERROR',
                [],
            ],
            'valid get request with headers' => [
                'GET',
                'https://example.com/api/endpoint',
                [ new Response(200, [], 'OK') ],
                null,
                'OK',
                ['SampleHeader' => 'SampleValue'],
            ],
            'invalid get request with headers' => [
                'GET',
                'https://example.com/api/endpoint',
                [ new Response(500, [], 'ERROR') ],
                null,
                'ERROR',
                ['SampleHeader' => 'SampleValue'],
            ],
            'valid post request without headers' => [
                'POST',
                'https://example.com/api/endpoint',
                [ new Response(200, [], 'OK') ],
                '{"key": "value"}',
                'OK',
                [],
            ],
            'invalid post request without headers' => [
                'POST',
                'https://example.com/api/endpoint',
                [ new Response(500, [], 'ERROR') ],
                '{"key": "value"}',
                'ERROR',
                [],
            ],
            'valid post request with headers' => [
                'POST',
                'https://example.com/api/endpoint',
                [ new Response(200, [], 'OK') ],
                '{"key": "value"}',
                'OK',
                ['SampleHeader' => 'SampleValue'],
            ],
            'invalid post request with headers' => [
                'POST',
                'https://example.com/api/endpoint',
                [ new Response(500, [], 'ERROR') ],
                '{"key": "value"}',
                'ERROR',
                ['SampleHeader' => 'SampleValue'],
            ],
        ];
    }
}
