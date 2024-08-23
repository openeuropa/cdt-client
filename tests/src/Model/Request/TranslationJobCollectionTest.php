<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\TranslationJobCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\TranslationJobCollection
 */
class TranslationJobCollectionTest extends TestCase
{
    use RequestModelTestTrait;
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\Request\TranslationJobCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection([
            $this->createRequestTranslationJob(['sourceLanguage' => 'EN']),
            $this->createRequestTranslationJob(['sourceLanguage' => 'FR']),
            $this->createRequestTranslationJob(['sourceLanguage' => 'ES']),
        ], TranslationJobCollection::class);
    }
}
