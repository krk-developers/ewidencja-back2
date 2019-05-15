<?php

namespace Tests\Unit;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use App\{Days, Worker, Legend};
// use Carbon\Carbon;
// use Carbon\CarbonPeriod;
// use Illuminate\Queue\Console\WorkCommand;
use App\Rules\LegendHelper;

class RuleEventTest extends TestCase
{
    /**
     * Whether the user filled out the fields start and end.
     *
     * @return void
     */
    public function testRequestIsNotNull()
    {
        
        $start = null;
        $end = null;
        $requestIsNotNull = LegendHelper::requestIsNotNull($start, $end);        
        $this->assertFalse($requestIsNotNull);


        $start = '15-05-2019';
        $end = null;
        $requestIsNotNull = LegendHelper::requestIsNotNull($start, $end);
        $this->assertFalse($requestIsNotNull);


        $start = null;
        $end = '15-05-2019';
        $requestIsNotNull = LegendHelper::requestIsNotNull($start, $end);
        $this->assertFalse($requestIsNotNull);


        $start = '15-05-2019';
        $end = '15-05-2019';
        $requestIsNotNull = LegendHelper::requestIsNotNull($start, $end);
        $this->assertNull($requestIsNotNull);
    }

    /**
     * Whether the right name of legend was found
     *
     * @return void
     */
    public function testFindLegend()
    {
        $id = 3;  // UW
        $legend = LegendHelper::findLegend($id);
        $legendName = $legend->name;
        $this->assertEquals('UW', $legendName);
    }
}
