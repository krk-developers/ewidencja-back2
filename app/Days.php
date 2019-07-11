<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonImmutable;
use App\{Event, Calendar};

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
        Collection $publicHolidaysInMonth
    ): CarbonPeriod {
        $publicHolidayFilter = function ($value) use ($publicHolidaysInMonth) {
            return ! in_array(
                $value->format('Y-m-d'),
                $publicHolidaysInMonth->toArray()
            );
        };
        
        return $timePeriod->filter($publicHolidayFilter);
    }
    
    public static function isPublicHoliday($date, $publicHolidaysInMonth)
    {
        return in_array($date->format('Y-m-d'), $publicHolidaysInMonth);
    }

    /**
     * Number of absences.
     *
     * @param Collection $workerEvents Worker's events
     * 
     * @return integer
     */
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
     * @param string $start Event's start
     * @param string $end   Event's end
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
     * Number of days in a given period time
     *
     * @param string $start Period start date YYYY-MM-DD
     * @param string $end   Period end date YYYY-MM-DD
     * 
     * @return integer
     */
    public static function timePeriodCount(string $start, string $end): int
    {
        $timePeriod = CarbonPeriod::between($start, $end);

        return $timePeriod->count();
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
        $date = new Carbon($day);

        return $date->isWeekend();
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

    // ///////////////////////////////////////////////////////////////////////

    /**
     * Start and end time period.
     *
     * @param string $yearMonth YYYY-MM
     * 
     * @return array
     */
    public static function startAndEnd(string $yearMonth): array
    {
        // start period time for which we calculate the statistics
        $start = Days::start($yearMonth);
        $monthName = $start->monthName;
        // current day or end of the month
        $end = Days::end($monthName, $start);

        return [$start, $end, $monthName];
    }

    /**
     * Public holidays in month
     *
     * @param CarbonImmutable $start Date start
     * 
     * @return Collection
     */
    public static function publicHolidaysInMonth(CarbonImmutable $start): Collection
    {
        // number of public holidays in a month
        return Event::publicHolidaysInMonth($start->year, $start->month);
    }

    /**
     * Worker calendar.
     *
     * @param Collection   $workerEvents                 Worker's events
     * @param CarbonPeriod $timePeriod                   Time period
     * @param array        $pluckedPublicHolidaysInMonth Plucked public holidays
     * 
     * @return array
     */
    public static function workerCalendar(
        Collection $workerEvents,
        CarbonPeriod $timePeriod,
        Collection $pluckedPublicHolidaysInMonth
    ): array {
        $calendar = new Calendar;
        return $workerCalendar = $calendar->make(
            $workerEvents, $timePeriod, $pluckedPublicHolidaysInMonth
        );
    }

    /**
     * Public holiday count.
     *
     * @param CarbonPeriod $timePeriod                   Time period
     * @param Collection   $pluckedPublicHolidaysInMonth Public holidays
     * 
     * @return integer
     */
    public static function workingDays(
        CarbonPeriod $timePeriod,
        Collection $pluckedPublicHolidaysInMonth
    ): int {
        $timePeriodPublicHolidayFilter = Days::publicHolidayFilter(
            $timePeriod, $pluckedPublicHolidaysInMonth
        );

        return $timePeriodPublicHolidayFilter->count();
    }

    /**
     * Working days and hours
     *
     * @param CarbonPeriod $timePeriod    Time period
     * @param integer      $absenceInDays Absence in days
     * 
     * @return array
     */
    public static function workedDaysAndHours(
        CarbonPeriod $timePeriod,
        int $absenceInDays
    ): array {
        $workingDays = $timePeriod->count() - $absenceInDays;
        $workingHours = $workingDays * config('record.working_hours_during_day');

        return [$workingDays, $workingHours];
    }
}
