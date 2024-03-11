<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\ValidationErrors
 */
class ValidationErrorsTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\ValidationErrors
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'errors' => [
                'field1' => ['TEST_ERROR_1', 'TEST_ERROR_2'],
                'field2' => ['TEST_ERROR_3'],
            ],
            'message' => 'TEST_MESSAGE',
        ];
        $validationErrors = $this->createResponseValidationErrors($data);

        $this->assertEquals($data['errors'], $validationErrors->getErrors());
        $this->assertEquals($data['message'], $validationErrors->getMessage());
    }
}
