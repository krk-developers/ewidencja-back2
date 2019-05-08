<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonImmutable;

class Days
{
    /**
     * String representation of class.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__;
    }

    /**
     * Date from slug
     *
     * @param string $yearMonth Slug
     * 
     * @return CarbonImmutable
     */
    public static function start(string $yearMonth): CarbonImmutable
    {
        // dd($yearMonth);
        return CarbonImmutable::parse($yearMonth);
    }

    /**
     * Set end of time period.
     * If current month, set time period at today.
     * Otherwise set end of the month.
     * 
     * @param string          $monthName Month name
     * @param CarbonImmutable $start     Start date
     * 
     * @return Carbon|CarbonImmutable
     */
    public static function end(string $monthName, CarbonImmutable $start): object
    {
        if ($monthName == Carbon::now()->monthName) {  // current month
            return Carbon::now();
        }
        
        return $start->endOfMonth();        
    }
    
    /**
     * Weekend filter.
     *
     * @param CarbonPeriod $timePeriod Time period
     * 
     * @return CarbonPeriod Filtered time period
     */
    public static function weekendFilter(CarbonPeriod $timePeriod): CarbonPeriod
    {
        $weekendFilter = function ($date) {
            return $date->isWeekday();
        };

        return $timePeriod->filter($weekendFilter);
    }

    /**
     * Public holiday filter.
     *
     * @param CarbonPeriod $timePeriod                   Time period
     * @param Collection   $pluckedPublicHolidaysInMonth Collection
     * 
     * @return CarbonPeriod Filtered time period
     */
    public static function publicHolidayFilter(
        CarbonPeriod $timePeriod,
        Collection $pluckedPublicHolidaysInMonth
    ): CarbonPeriod {
        $publicHolidayFilter = function ($value) use ($pluckedPublicHolidaysInMonth) {
            return ! in_array(
                $value->format('Y-m-d'),
                $pluckedPublicHolidaysInMonth->toArray()
            );
        };
        
        return $timePeriod->filter($publicHolidayFilter);
    }
    
    public static function absenceInDays(Collection $workerEvents): int
    {
        $absenceInDays = 0;
        foreach ($workerEvents as $event) {
            $absencePeriod = CarbonPeriod::between($event->start, $event->end);
            $absenceInDays += $absencePeriod->count();
        }

        return $absenceInDays;
    }
    
    /*
    public static function createTimePeriod(Carbon $start, Carbon $end): CarbonPeriod
    {
        return CarbonPeriod::between($start, $end);
    }

    public static function weekendFilter(CarbonPeriod $timePeriod): CarbonPeriod
    {
        $weekendFilter = function ($date) {
            return $date->isWeekday();
        };

        return $timePeriod->filter($weekendFilter);
    }
    
    public static function workerEventFilter(
        CarbonPeriod $timePeriod,
        Collection $events
    ): CarbonPeriod {
        $workerEventFilter = function ($value) use ($events) {
            return ! in_array($value->format('Y-m-d'), $events->toArray());
        };

        return $timePeriod->filter($workerEventFilter);
    }
    
    public static function publicHolidayFilter(
        CarbonPeriod $timePeriod,
        Collection $pluckedPublicHolidays
    ): CarbonPeriod {
        $publicHolidayFilter = function ($value) use ($pluckedPublicHolidays) {
            return ! in_array(
                $value->format('Y-m-d'),
                $pluckedPublicHolidays->toArray()
            );
        };

        return $timePeriod->filter($publicHolidayFilter);
    }
    */
}
