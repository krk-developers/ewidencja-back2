<?php

declare(strict_types = 1);

namespace App\Rules;

use Carbon\Carbon;
use App\{Legend, Days, Worker};

/**
 * Helper class for Legend rule
 */
class LegendHelper
{
    /**
     * Event's date start and end can not be null
     *
     * @param string|null $start Event's start date
     * @param string|null $end   Event's end date
     * 
     * @return bool|none
     */
    public static function requestIsNotNull(?string $start, ?string $end): bool
    {
        if ($start == null) {
            return false;
        }
        
        if ($end == null) {
            return false;
        }

        return true;
    }

    /**
     * Find Legend by its primary key
     *
     * @param integer $legendID Primary key
     * 
     * @return Legend
     */
    public static function findLegend(int $legendID): Legend
    {
        return Legend::find_($legendID);
    }

    /**
     * Childcare day validation.
     *
     * @param Worker $worker Worker
     * @param string $start  Event start YYYY-MM-DD
     * 
     * @return boolean
     */
    public static function childcareDaysNumber(Worker $worker, string $start): bool
    {
        $carbon = new Carbon($start);
        $year = $carbon->year;

        $childcareDays = $worker::childcareDay($worker->id, $year);
     
        $takenDaysNumber = 0;
        foreach ($childcareDays as $day) {
            $start = $day->start;
            $end = $day->end;
            $takenDaysNumber += Days::timePeriodCount($start, $end);
        }
        // dd($takenDaysNumber);
        if ($takenDaysNumber >= config('record.childcare_day')) {
            return false;
        }

        return true;
    }

    public static function timePeriodChildcareDaysNumber(
        string $eventStart, string $eventEnd
    ): bool {
        $takenDaysNumber = Days::timePeriodCount($eventStart, $eventEnd);

        return $takenDaysNumber <= config('record.childcare_day');
    }

    public static function eventsOverlap(Worker $worker, int $employerID, string $eventStart, string $eventEnd): int
    {
        $events = $worker->eventsByEmployerID(
            $employerID, $eventStart, $eventEnd
        );

        return $events->count();
    }
}
