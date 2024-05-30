<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Endpoint\RequestsEndpoint;
use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Response\Token;
use OpenEuropa\CdtClient\Model\Response\ValidationErrors;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\RequestsEndpoint
 */
class RequestsEndpointTest extends TestCase
{
    use ClientTestTrait;
    use AssertTestRequestTrait;
    use RequestModelTestTrait;

    /**
     * @dataProvider providerTestRequests
     *
     * @param array<string, mixed> $clientConfig
     * @param array<string, mixed> $requestArray
     * @param Response[] $responses
     *
     * @covers \OpenEuropa\CdtClient\Endpoint\RequestsEndpoint
     * @covers \OpenEuropa\CdtClient\Endpoint\EndpointBase
     * @covers \OpenEuropa\CdtClient\Http\Rest
     */
    public function testRequests(array $clientConfig, array $requestArray, string $requestJson, array $responses, string|ValidationErrors $expectedResult): void
    {
        $token = (new Token())->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $client = $this->getTestingClient($clientConfig, $responses);
        $apiFactory = $this->getClientApiFactory($client);
        $requestsEndpoint = $apiFactory->createEndpoint(RequestsEndpoint::class);
        assert($requestsEndpoint instanceof RequestsEndpoint);

        $requestsEndpoint->setToken($token);
        $this->assertEquals($token, $requestsEndpoint->getToken());

        $translationRequest = $this->createRequestTranslation($requestArray);
        try {
            $result = $requestsEndpoint->sendTranslationRequest($translationRequest);
        } catch (ValidationErrorsException $e) {
            $result = $e->getValidationErrors();
        }
        $this->assertEquals($expectedResult, $result);

        $this->assertCount(1, $this->clientHistory);
        $request = $this->clientHistory[0]['request'];
        assert($request instanceof RequestInterface);
        $this->assertAuthorizationHeaders($request);
        $this->assertEquals($request->getBody()->__toString(), $requestJson);
    }

    /**
     * @see self::testRequests()
     *
     * @return array<string, array<int, mixed>>
     */
    public static function providerTestRequests(): array
    {
        return [
            'valid' => [
                [
                    'apiBaseUrl' => 'https://example.com',
                ],
                [
                ],
                (string) file_get_contents(__DIR__ . '/../../fixtures/json/requests_valid_request.json'),
                [
                    new Response(200, [], '1xWrUG')
                ],
                '1xWrUG',
            ],
            'failed_validation' => [
                [
                    'apiBaseUrl' => 'https://example.com',
                ],
                [
                    'deliveryModeCode' => 'FOOBAR'
                ],
                (string) file_get_contents(__DIR__ . '/../../fixtures/json/requests_invalid_request.json'),
                [
                    new Response(400, [], (string) file_get_contents(__DIR__ . '/../../fixtures/json/requests_error_response.json'))
                ],
                (new ValidationErrors())
                    ->setMessage('Validation error')
                    ->setErrors([
                        'deliveryModeCode' => ['Invalid delivery mode FOOBAR']
                    ]),
            ]
        ];
    }
}
