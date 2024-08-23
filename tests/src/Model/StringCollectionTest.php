<?php

declare(strict_types=1);

namespace OpenEuropa\Tests\CdtClient\Model;

use OpenEuropa\CdtClient\Model\StringCollection;
use OpenEuropa\Tests\CdtClient\Traits\CollectionTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenEuropa\CdtClient\Model\StringCollection
 */
class StringCollectionTest extends TestCase
{
    use CollectionTestTrait;

    /**
     * @covers \OpenEuropa\CdtClient\Model\BaseCollection
     * @covers \OpenEuropa\CdtClient\Model\StringCollection
     */
    public function testCollection(): void
    {
        $this->assertCollection(['one', 'two', 'three'], StringCollection::class);
    }
}
