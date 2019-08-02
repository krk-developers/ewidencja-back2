<?php

declare(strict_types = 1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Record\IndividualHelper;

class IndividualHelperTest extends TestCase
{
    /**
     * File name test.
     *
     * @return void
     */
    public function testFilename(): void
    {
        $helper = new IndividualHelper();
        $this->assertIsObject($helper);

        $this->assertEquals(
            'Jan-Kowalski-Microsoft-2019-06.pdf',
            $helper->filename('Jan', 'Kowalski', 'Microsoft', '2019-06', 'pdf')
        );
        $this->assertEquals(
            'Mariusz-Nowak-Apple Inc.-2019-07.xlsx',
            $helper->filename('Mariusz', 'Nowak', 'Apple Inc.', '2019-07', 'xlsx')
        );
    }
}
