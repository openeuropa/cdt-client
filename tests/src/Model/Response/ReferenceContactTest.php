<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\ReferenceContact
 */
class ReferenceContactTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\ReferenceContact
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'email' => 'someone@example.com',
            'phoneNumber' => '1234567890',
            'phoneCountryCode' => 'ES',
            'countryCode' => 'ES',
            'countryName' => 'Spain',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'userName' => 'JDoe',
        ];
        $referenceContact = $this->createResponseReferenceContact($data);

        $this->assertEquals($data['email'], $referenceContact->getEmail());
        $this->assertEquals($data['phoneNumber'], $referenceContact->getPhoneNumber());
        $this->assertEquals($data['phoneCountryCode'], $referenceContact->getPhoneCountryCode());
        $this->assertEquals($data['countryCode'], $referenceContact->getCountryCode());
        $this->assertEquals($data['countryName'], $referenceContact->getCountryName());
        $this->assertEquals($data['firstName'], $referenceContact->getFirstName());
        $this->assertEquals($data['lastName'], $referenceContact->getLastName());
        $this->assertEquals($data['userName'], $referenceContact->getUserName());
    }
}
