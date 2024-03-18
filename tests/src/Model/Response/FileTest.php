<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Response;

use OpenEuropa\Tests\CdtClient\Traits\ResponseModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Response\File
 */
class FileTest extends TestCase
{
    use ResponseModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Response\File
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'fileName' => 'test.txt',
            'sourceLanguage' => 'FR',
            'targetLanguage' => 'PL',
            'sourceDocument' => 'source.xml',
            'isPrivate' => true,
        ];
        $file = $this->createResponseFile($data);

        $this->assertEquals($data['fileName'], $file->getFilename());
        $this->assertEquals($data['sourceLanguage'], $file->getSourceLanguage());
        $this->assertEquals($data['targetLanguage'], $file->getTargetLanguage());
        $this->assertEquals($data['sourceDocument'], $file->getSourceDocument());
        $this->assertEquals($data['isPrivate'], $file->isPrivate());
        $this->assertIsArray($file->getLinks());
    }
}
