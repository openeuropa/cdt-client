<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Endpoint\ValidateEndpoint;
use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Response\ValidationErrors;
use OpenEuropa\CdtClient\Model\Token;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\ValidateEndpoint
 */
class ValidateEndpointTest extends TestCase
{
    use ClientTestTrait;
    use AssertTestRequestTrait;
    use RequestModelTestTrait;

    /**
     * @dataProvider providerTestValidate
     *
     * @param array<string, mixed> $clientConfig
     * @param array<string, mixed> $requestArray
     * @param Response[] $responses
     *
     * @covers ::execute
     * @covers ::setToken
     * @covers ::getToken
     * @covers ::getRequestHeaders
     * @covers ::getRequestJsonBody
     * @covers ::setTranslationRequest
     * @covers ::getTranslationRequest
     */
    public function testValidate(array $clientConfig, array $requestArray, string $requestJson, array $responses, bool|ValidationErrors $expectedResult): void
    {
        $token = (new Token())->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $client = $this->getTestingClient($clientConfig, $responses);
        $container = $this->getClientContainer($client);
        $validateEndpoint = $container->get('validate');
        assert($validateEndpoint instanceof ValidateEndpoint);

        $validateEndpoint->setToken($token);
        $this->assertEquals($token, $validateEndpoint->getToken());

        $translationRequest = $this->createRequestTranslation($requestArray);
        $validateEndpoint->setTranslationRequest($translationRequest);
        $this->assertEquals($translationRequest, $validateEndpoint->getTranslationRequest());

        try {
            $result = $validateEndpoint->execute();
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
     * @see self::testValidate()
     *
     * @return array<string, array<int, mixed>>
     */
    public static function providerTestValidate(): array
    {
        return [
            'valid' => [
                [
                    'validateApiEndpoint' => 'https://example.com/v2/requests/validate',
                ],
                [
                ],
                (string) file_get_contents(__DIR__ . '/../../fixtures/json/validate_valid_request.json'),
                [
                    new Response(200, [], 'true')
                ],
                true,
            ],
            'failed_validation' => [
                [
                    'validateApiEndpoint' => 'https://example.com/v2/requests/validate',
                ],
                [
                    'deliveryModeCode' => 'FOOBAR'
                ],
                (string) file_get_contents(__DIR__ . '/../../fixtures/json/validate_invalid_request.json'),
                [
                    new Response(400, [], (string) file_get_contents(__DIR__ . '/../../fixtures/json/validate_error_response.json'))
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
