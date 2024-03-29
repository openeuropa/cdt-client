<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\File
 */
class FileTest extends TestCase
{
    use RequestModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\File
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'filename' => 'test_file.txt',
            'content' => 'abcde',
        ];
        $file = $this->createRequestFile($data);

        $this->assertEquals($data['filename'], $file->getFilename());
        $this->assertEquals($data['content'], $file->getContent());
    }

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\File
     */
    public function testSerialize(): void
    {
        $data = [
            'filename' => 'test_file.txt',
            'content' => 'abcde',
        ];
        $file = $this->createRequestFile($data);
        $this->assertEquals([
            'fileName' => $data['filename'],
            'base64Data' => 'YWJjZGU=',
        ], $file->jsonSerialize());
    }
}
