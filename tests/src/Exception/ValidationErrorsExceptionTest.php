<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Exception;

use OpenEuropa\CdtClient\Exception\ValidationErrorsException;
use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Exception\ValidationErrorsException
 */
class ValidationErrorsExceptionTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Exception\ValidationErrorsException
     */
    public function testCreatingException(): void
    {
        $data = [
            'errors' => [
                'field1' => ['Error 1', 'Error 2'],
                'field2' => ['Error 3'],
            ],
            'message' => 'Test message',
        ];
        $validationErrors = $this->createResponseValidationErrors($data);
        $exception = new ValidationErrorsException('Test message', 0, null, $validationErrors);

        $this->assertEquals($validationErrors, $exception->getValidationErrors());
        $this->assertEquals('Test message', $exception->getMessage());
    }
}
