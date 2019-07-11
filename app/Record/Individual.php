<?php

declare(strict_types = 1);

namespace App\Record;

use Carbon\{Carbon, CarbonPeriod};
use App\{Days, Legend, Worker, Employer};
use App\Exports\CommonData;

class Individual
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
     * Calculate individual records
     *
     * @param Worker   $worker    Worker
     * @param Employer $employer  Employer
     * @param string   $yearMonth YYYY-MM
     * 
     * @return array
     */
    public function calculate(
        Worker $worker,
        Employer $employer,
        string $yearMonth
    ): array {
        $legend = Legend::allSortBy();
        
        $commonData = new CommonData();
        $seperateLegend = $commonData->seperateLegend($legend);
        
        list($start, $end, $monthName) = Days::startAndEnd($yearMonth);

        $yearMonth = $start->format('Y-m');
        $daysInMonth = $start->daysInMonth;  // number of days in a month
        
        // whether the user calculates statistics for a future date
        $isFuture = $start > Carbon::now();

        $previousMonthStart = $start->subMonth()->startOfMonth();
        $previousMonthStartAsYearMonth = $previousMonthStart->format('Y-m');
        $nextMonth = $start->addMonth()->format('Y-m');

        // the period of time for which we calculate the statistics
        $timePeriod = CarbonPeriod::between($start, $end);
        
        // number of public holidays in a month
        $publicHolidaysInMonth = Days::publicHolidaysInMonth($start);
        $publicHolidaysInMonthCount = $publicHolidaysInMonth->count();
        // dd($publicHolidaysInMonth);
        $pluckedPublicHolidaysInMonth = $publicHolidaysInMonth->pluck('start');

        $workerEvents = $worker->eventsByTimePeriod1(
            (string) $start, (string) $end, $employer->id
        );

        $workerCalendar = Days::workerCalendar(
            $workerEvents, $timePeriod, $pluckedPublicHolidaysInMonth
        );
        
        $timePeriod = Days::weekendFilter($timePeriod);

        $workingDays = Days::workingDays(
            $timePeriod,
            $pluckedPublicHolidaysInMonth
        );

        $absenceInDays = Days::absenceInDays($workerEvents);

        list($workerWorkedDays, $workerWorkedHours) = Days::workedDaysAndHours($timePeriod, $absenceInDays);

        $name = $worker->user->name . ' ' . $worker->lastname;

        $data = [
            'worker' => $worker,
            'employer' => $employer,
            'yearMonth' => $yearMonth,
            'days_in_month' => $daysInMonth,
            'working_days' => $workingDays,
            'public_holidays_in_month' => $publicHolidaysInMonth,
            'public_holidays_in_month_count' => $publicHolidaysInMonthCount,
            'absence_in_days' => $absenceInDays,
            'worker_worked_days' => $workerWorkedDays,
            'worker_worked_hours' => $workerWorkedHours,
            'events' => $workerEvents,
            'calendar' => $workerCalendar,
            'legend' => $legend,
            'legend_names' => $seperateLegend['legendNames'],
            'legend_display_names' => $seperateLegend['legendDisplayNames'],
            'name' => $name,
            'is_future' => $isFuture,
            'start' => $start,
            'end' => $end,
            'month_name' => $monthName,
            'previous_month' => $previousMonthStartAsYearMonth,
            'next_month' => $nextMonth,
            'year_month' => $yearMonth,
        ];

        return $data;
    }
}
