<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Days;

class DaysTest extends TestCase
{
    /**
     * Whether the dates are working days
     *
     * @return void
     */
    public function testAreWorkingDays()
    {
        $friday = '2019-05-17';
        $monday = '2019-05-20';
        $areWorkingDays = Days::areWorkingDays($friday, $monday);
        $this->assertFalse($areWorkingDays);

        $monday = '2019-05-13';
        $friday = '2019-05-17';
        $areWorkingDays = Days::areWorkingDays($monday, $friday);
        $this->assertTrue($areWorkingDays);
    }

    /**
     * If the given date is weekend day
     *
     * @return void
     */
    public function testIsWeekend()
    {
        $friday = '2019-05-17';
        $isWeekend = Days::isWeekend($friday);
        $this->assertFalse($isWeekend);


        $saturday = '2019-05-18';
        $isWeekend = Days::isWeekend($saturday);
        $this->assertTrue($isWeekend);
    }

    /**
     * If both, start and end date are weekend days
     *
     * @return void
     */
    public function testAreWeekend()
    {
        $thursday = '2019-05-17';
        $friday = '2019-05-17';
        $areWeekend = Days::areWeekend($thursday, $friday);
        $this->assertFalse($areWeekend);
        
        $friday = '2019-05-17';
        $saturday = '2019-05-18';
        $areWeekend = Days::areWeekend($friday, $saturday);
        $this->assertFalse($areWeekend);
        
        $saturday = '2019-05-18';
        $sunday = '2019-05-19';
        $areWeekend = Days::areWeekend($saturday, $sunday);
        $this->assertTrue($areWeekend);
    }

    /**
     * Whether the dates are in correct order.
     *
     * @return void
     */
    public function testCorrectOrder()
    {
        $sunday = '2019-05-19';
        $saturday = '2019-05-18';
        $correctOrder = Days::correctOrder($sunday, $saturday);
        $this->assertFalse($correctOrder);

        $sunday = '2019-05-19';
        $sunday = '2019-05-19';
        $correctOrder = Days::correctOrder($sunday, $sunday);
        $this->assertTrue($correctOrder);

        $saturday = '2019-05-18';
        $sunday = '2019-05-19';
        $correctOrder = Days::correctOrder($saturday, $sunday);
        $this->assertTrue($correctOrder);
    }
    
    /**
     * A vacation leave only on working days.
     * (UW - Urlop Wypoczynkowy)
     *
     * @return void
     */
    public function testUW()
    {
        $friday = '2019-05-17';
        $tuesday = '2019-05-21';
        $onlyWorkingDays = Days::areWorkingDays($friday, $tuesday);
        $this->assertFalse($onlyWorkingDays);


        $tuesday = '2019-05-14';
        $friday = '2019-05-17';
        $onlyWorkingDays = Days::areWorkingDays($tuesday, $friday);
        $this->assertTrue($onlyWorkingDays);
    }
}
