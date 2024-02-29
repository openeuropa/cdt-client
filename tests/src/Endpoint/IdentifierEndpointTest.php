<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\CdtClient\Model\Response\ValidationErrors;
use OpenEuropa\CdtClient\Model\Token;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\IdentifierEndpoint
 */
class IdentifierEndpointTest extends TestCase
{
    use ClientTestTrait;
    use AssertTestRequestTrait;

    /**
     * @dataProvider providerTestIdentifier
     *
     * @param array<string, mixed> $clientConfig
     * @param Response[] $responses
     * @param mixed $expectedResult
     *
     * @covers \OpenEuropa\CdtClient\Endpoint\IdentifierEndpoint
     * @covers \OpenEuropa\CdtClient\Endpoint\EndpointBase
     */
    public function testIdentifier(string $correlationId, array $clientConfig, array $responses, mixed $expectedResult): void
    {
        $token = (new Token())->setAccessToken('JWT_TOKEN')
            ->setTokenType('bearer')
            ->setExpiresIn(3600);
        $client = $this->getTestingClient($clientConfig, $responses);
        $container = $this->getClientContainer($client);
        $identifierEndpoint = $container->get('identifier');
        $identifierEndpoint->setToken($token);
        $this->assertEquals($token, $identifierEndpoint->getToken());
        $identifierEndpoint->setCorrelationId($correlationId);
        $this->assertEquals($correlationId, $identifierEndpoint->getCorrelationId());

        try {
            $result = $identifierEndpoint->execute();
        } catch (ValidationErrorsException $e) {
            $result = $e->getValidationErrors();
        }
        $this->assertEquals($expectedResult, $result);
        $this->assertCount(1, $this->clientHistory);
        $request = $this->clientHistory[0]['request'];
        $this->assertIdentifierRequest($request, $correlationId);
        $this->assertAuthorizationHeaders($request);
    }

    /**
     * @see self::testIdentifier()
     *
     * @return array<string, array<int, mixed>>
     */
    public static function providerTestIdentifier(): array
    {
        return [
            'connected' => [
                '12345',
                [
                    'identifierApiEndpoint' => 'https://example.com/v2/requests/requestIdentifierByCorrelationId/:correlationId',
                ],
                [
                    new Response(200, [], '2024/332233')
                ],
                '2024/332233',
            ],
            'failed' => [
                'AbCdE',
                [
                    'identifierApiEndpoint' => 'https://example.com/v2/requests/requestIdentifierByCorrelationId/:correlationId',
                ],
                [
                    new Response(400, [], (string) file_get_contents(__DIR__ . '/../../fixtures/json/identifier_error_response.json'))
                ],
                (new ValidationErrors())
                    ->setMessage('The requestIdentifier does not exists for the correlationID -> AbCdE')
                    ->setErrors([])
            ]
        ];
    }
}
