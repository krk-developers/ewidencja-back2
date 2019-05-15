<?php

namespace Tests\Unit;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\{Days, Worker};
// use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Queue\Console\WorkCommand;

class DaysTest extends TestCase
{
    /**
     * A vacation leave event test. (UW - Urlop Wypoczynkowy)
     *
     * @return void
     */
    public function testUW()
    {
        $start = '2019-05-17';
        $end = '2019-05-21';
        $timePeriod = CarbonPeriod::between($start, $end);  // includes a weekend day
        $onlyWorkingDays = Days::areWorkingDays($timePeriod);

        $this->assertFalse($onlyWorkingDays);


        $start = '2019-05-14';
        $end = '2019-05-17';
        $timePeriod = CarbonPeriod::between($start, $end);  // includes only week day
        $onlyWorkingDays = Days::areWorkingDays($timePeriod);

        $this->assertTrue($onlyWorkingDays);
    }

    public function testIsWeekendDay()
    {
        $friday = '2019-05-17';
        $isWeekend = Days::isWeekend($friday);

        $this->assertFalse($isWeekend);


        $saturday = '2019-05-18';
        $isWeekend = Days::isWeekend($saturday);

        $this->assertTrue($isWeekend);
    }

    /**
     * Test day of childcare.
     * Maximum two day a year.
     * DOD - Dzień opieki nad dzieckiem.
     *
     * @return void
     */
    public function testDOD()
    {
        $worker = Worker::find_(1);
        $year = 2019;
        $maximumTwoDaysAyear = 2;

        $childcareDayCount = Worker::childcareDayCount($worker->id, $year);
        dd($childcareDayCount);
        $this->assertLessThanOrEqual($maximumTwoDaysAyear, $childcareDayCount);
    }
}
