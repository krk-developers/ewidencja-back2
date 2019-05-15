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
    
    /**
     * Whether time period are working days
     *
     * @param CarbonPeriod $timePeriod Time period
     * 
     * @return boolean
     */
    public static function areWorkingDays($start, $end): bool
    {
        $timePeriod = CarbonPeriod::between($start, $end);

        foreach ($timePeriod as $date) {
            if ($date->isWeekend()) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Whether is weekend day.
     *
     * @param string $day Day. Format YYYY-MM-DD
     * 
     * @return boolean
     */
    public static function isWeekend(string $day): bool
    {
        $dt = new Carbon($day);

        return $dt->isWeekend();
    }

    /**
     * If both, start and end are weekend days
     *
     * @param string $start Day one
     * @param string $end   Day two
     * 
     * @return boolean
     */
    public static function areWeekend(string $start, string $end): bool
    {
        $day1 = self::isWeekend($start);
        $day2 = self::isWeekend($end);

        if ($day1 == true && $day2 == true) {
            return true;
        }

        return false;
    }
    
    /**
     * Is the start date earlier than the end date
     *
     * @param string $start YYYY-MM-DD
     * @param string $end   YYYY-MM-DD
     * 
     * @return boolean
     */
    public static function correctOrder(string $start, string $end): bool
    {
        $first = Carbon::create($start);
        $second = Carbon::create($end);
        
        return $first->lessThanOrEqualTo($second);
    }

    /*
    public static function createTimePeriod(Carbon $start, Carbon $end): CarbonPeriod
    {
        return CarbonPeriod::between($start, $end);
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
