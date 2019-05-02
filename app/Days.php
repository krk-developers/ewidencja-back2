<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Days
{
    public function __toString()
    {
        return __CLASS__;
    }

    public static function pluck(Collection $events): Collection
    {
        return $events->pluck('start');
    }

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
}
