<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model\Request;

use OpenEuropa\CdtClient\Model\Request\TranslationJob;
use OpenEuropa\CdtClient\Model\Request\TranslationJobCollection;
use OpenEuropa\Tests\CdtClient\Traits\AssertTestCollectionTrait;
use OpenEuropa\Tests\CdtClient\Traits\RequestModelTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\Request\TranslationJobCollection
 */
class TranslationJobCollectionTest extends TestCase
{
    use RequestModelTestTrait;
    use AssertTestCollectionTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\Request\TranslationJobCollection
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     */
    public function testCollection(): void
    {
        $items = [
            $this->createRequestTranslationJob([
                'sourceLanguage' => 'fr',
            ]),
            $this->createRequestTranslationJob([
                'sourceLanguage' => 'es',
            ]),
        ];

        $collection = new TranslationJobCollection($items);
        $this->assertCollection($collection, TranslationJob::class, $items);
    }
}
