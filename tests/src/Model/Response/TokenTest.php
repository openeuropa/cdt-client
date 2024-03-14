<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\Token
 */
class TokenTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\Token
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'accessToken' => 'TEST_TOKEN',
            'expiresIn' => 3600,
            'tokenType' => 'TEST_TYPE',
            'refreshToken' => '{\"TokenId\":\"12345678901234561234567890abcdef\",\"Issued\":\"2024-02-21T07:28:37.7644661Z\",\"Expires\":\"2024-02-22T07:28:37.7644661Z\"}',
        ];
        $token = $this->createResponseToken($data);

        $this->assertEquals($data['accessToken'], $token->getAccessToken());
        $this->assertEquals($data['expiresIn'], $token->getExpiresIn());
        $this->assertEquals($data['tokenType'], $token->getTokenType());
        $this->assertEquals($data['refreshToken'], $token->getRefreshToken());
    }
}
