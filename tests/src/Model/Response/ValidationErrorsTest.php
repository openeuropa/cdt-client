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
                'field1' => ['Error 1', 'Error 2'],
                'field2' => ['Error 3'],
            ],
            'message' => 'Test message',
        ];
        $validationErrors = $this->createResponseValidationErrors($data);

        $this->assertEquals($data['errors'], $validationErrors->getErrors());
        $this->assertEquals($data['message'], $validationErrors->getMessage());
    }
}
