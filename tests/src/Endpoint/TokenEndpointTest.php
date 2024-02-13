<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Endpoint;

use GuzzleHttp\Psr7\Response;
use OpenEuropa\CdtClient\Endpoint\TokenEndpoint;
use OpenEuropa\CdtClient\Model\Token;
use OpenEuropa\Tests\CdtClient\Traits\ClientTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestRequestTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Endpoint\TokenEndpoint
 */
class TokenEndpointTest extends TestCase
{
    use ClientTestTrait;
    use AssertTestRequestTrait;

    /**
     * @dataProvider providerTestToken
     *
     * @param array $clientConfig
     * @param array $responses
     * @param mixed $expectedResult
     */
    public function testToken(array $clientConfig, array $responses, $expectedResult): void
    {
        $client = $this->getTestingClient($clientConfig, $responses);
        $container = $this->getClientContainer($client);

        $this->assertEquals($expectedResult, $container->get('auth')->execute());
        $this->assertCount(1, $this->clientHistory);
        $request = $this->clientHistory[0]['request'];
        $this->assertTokenRequest($request);
    }

    /**
     * @dataProvider providerTestInvalidConfig
     */
    public function testInvalidConfig($username, $password, $client, string $exceptionMessage): void
    {
        $this->expectExceptionObject(new InvalidOptionsException($exceptionMessage));
        new TokenEndpoint('https://example.com/token', [
            'username' => $username,
            'password' => $password,
            'client' => $client,
        ]);
    }

    public function testMissingConfig(): void
    {
        $this->expectExceptionObject(new MissingOptionsException('The required options "client", "password", "username" are missing.'));
        new TokenEndpoint('https://example.com/token');
    }

    public function testDefinedConfig(): void
    {
        $this->expectExceptionObject(new UndefinedOptionsException('The option "foo" does not exist. Defined options are: "client", "endpointUrl", "password", "username".'));
        new TokenEndpoint('https://example.com/token', [
            'foo' => 'bar',
        ]);
    }

    /**
     * @return array
     */
    public static function providerTestToken(): array
    {
        return [
            'simple token call' => [
                [
                    'tokenApiEndpoint' => 'https://example.com/token',
                    'username' => 'baz',
                    'password' => 'qux',
                    'client' => 'foo',
                ],
                [
                    new Response(200, [], file_get_contents(__DIR__ . '/../../fixtures/json/simple_token_call_response.json'))
                ],
                (new Token())
                    ->setAccessToken('JWT_TOKEN')
                    ->setTokenType('bearer')
                    ->setExpiresIn(28799)
                    ->setRefreshToken('{"TokenId":"thetokenidvalue","Issued":"2024-02-06T13:01:40.2029898Z","Expires":"2024-02-07T13:01:40.2029898Z"}'),
            ],
        ];
    }

    /**
     * @return array[]
     */
    public static function providerTestInvalidConfig(): array
    {
        return [
            'wrong "username" format' => [
                1,
                'testpass',
                'testclient',
                'The option "username" with value 1 is expected to be of type "string", but is of type "int',
            ],
            'wrong "password" format' => [
                'testusername',
                1,
                'testclient',
                'The option "password" with value 1 is expected to be of type "string", but is of type "int',
            ],
            'wrong "client" format' => [
                'testusername',
                'testpass',
                1,
                'The option "client" with value 1 is expected to be of type "string", but is of type "int',
            ],
        ];
    }
}
