<?php

declare(strict_types = 1);

namespace App\Record;

use Carbon\{Carbon, CarbonPeriod};
use App\{Days, Event, Legend, Calendar, Worker, Employer};
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
        // $legendCollection = collect($legend);
        //$legendGroups = $legendCollection->split(2);
        
        $commonData = new CommonData();
        $seperateLegend = $commonData->seperateLegend($legend);
        // dd($seperateLegend);
        $start = Days::start($yearMonth);  // start period time for which we calculate the statistics
        $monthName = $start->monthName;
        $end = Days::end($monthName, $start);  // current day or end of the month
        $yearMonth = $start->format('Y-m');

        $daysInMonth = $start->daysInMonth;  // number of days in a month
        
        $isFuture = $start > Carbon::now();  // whether the user calculates statistics for a future date

        $previousMonthStart = $start->subMonth()->startOfMonth();
        $previousMonthStartAsYearMonth = $previousMonthStart->format('Y-m');
        $nextMonth = $start->addMonth()->format('Y-m');

        $timePeriod = CarbonPeriod::between($start, $end);  // the period of time for which we calculate the statistics
        
        // number of public holidays in a month
        $publicHolidaysInMonth = Event::publicHolidaysInMonth(
            $start->year, $start->month
        );
        $pluckedPublicHolidaysInMonth = $publicHolidaysInMonth->pluck('start');

        $workerEvents = $worker->eventsByTimePeriod1((string) $start, (string) $end, $employer->id);

        $calendar = new Calendar;
        $workerCalendar = $calendar->make($workerEvents, $timePeriod, $pluckedPublicHolidaysInMonth);

        $timePeriod = Days::weekendFilter($timePeriod);

        $timePeriodPublicHolidayFilter = Days::publicHolidayFilter(
            $timePeriod, $pluckedPublicHolidaysInMonth
        );
        $timePeriodPublicHolidayFilterCount = $timePeriodPublicHolidayFilter
            ->count();

        $absenceInDays = Days::absenceInDays($workerEvents);
        $workingDays = $timePeriod->count() - $absenceInDays;
        $workingHoursDuringMonth = $workingDays * config(
            'record.working_hours_during_day'
        );

        $name = $worker->user->name . ' ' . $worker->lastname;

        $data = [
            'worker' => $worker,
            'employer' => $employer,
            'yearMonth' => $yearMonth,
            'days_in_month' => $daysInMonth,
            'time_period_public_holiday_filter' => 
                $timePeriodPublicHolidayFilterCount,
            'public_holidays_in_month_count' => $publicHolidaysInMonth->count(),
            'absence_in_days' => $absenceInDays,
            'working_days' => $workingDays,
            'working_hours_during_month' => $workingHoursDuringMonth,
            'events' => $workerEvents,
            'calendar' => $workerCalendar,
            // 'legend_groups' => $legendGroups,
            'legend_names' => $seperateLegend['legendNames'],
            'legend_display_names' => $seperateLegend['legendDisplayNames'],
            'name' => $name,
        ];

        return $data;
    }
}
