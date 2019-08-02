<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Record\CollectiveHelper;

class CollectiveHelperTest extends TestCase
{
    /**
     * File name test.
     *
     * @return void
     */
    public function testFilename()
    {
        $helper = new CollectiveHelper();

        $this->assertEquals(
            'Apple-2019-05.pdf',
            $helper->filename('Apple', '2019-05', 'pdf')
        );
        $this->assertEquals(
            'Microsoft-2019-06.xlsx',
            $helper->filename('Microsoft', '2019-06', 'xlsx')
        );
    }
}
