<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\TranslationJob
 */
class TranslationJobTest extends TestCase
{
    use RequestModelTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\TranslationJob
     */
    public function testSettersAndGetters(): void
    {
        $data = [
            'sourceLanguage' => 'fr',
            'targetLanguage' => 'es',
            'volume' => 0.5,
        ];
        $translationJob = $this->createRequestTranslationJob($data);

        $this->assertEquals($data['sourceLanguage'], $translationJob->getSourceLanguage());
        $this->assertEquals($data['targetLanguage'], $translationJob->getTargetLanguage());
        $this->assertEquals($data['volume'], $translationJob->getVolume());
    }
}
