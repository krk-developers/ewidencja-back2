<?php

declare(strict_types = 1);

namespace App\Record;

// use Illuminate\Support\Collection;
use Carbon\{Carbon, CarbonPeriod};
use App\{Days, Event, Legend, Calendar, Employer};
// use PDF;

class Collective
{
    /**
     * String representation of class.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__;
        // $admin = $request->query('admin');
    }

    /**
     * Calculate a records.
     *
     * @param Employer $employer  Employer
     * @param string   $yearMonth YYYY-MM
     * 
     * @return array
     */
    public function calculate(Employer $employer, string $yearMonth): array
    {
        // start period time for which we calculate the statistics
        $start = Days::start($yearMonth);
        
        $monthName = $start->monthName;

        // current day or end of the month
        $end = Days::end($monthName, $start);

        $daysInMonth = $start->daysInMonth;  // number of days in a month
        
        // whether the user calculates statistics for a future date
        $isFuture = $start > Carbon::now();

        $previousMonthStart = $start->subMonth()->startOfMonth();
        $previousMonthStartAsYearMonth = $previousMonthStart->format('Y-m');
        $nextMonth = $start->addMonth()->format('Y-m');

        // the period of time for which we calculate the statistics
        $timePeriod = CarbonPeriod::between($start, $end);

        $timePeriod = Days::weekendFilter($timePeriod);

        // number of public holidays in a month
        $publicHolidaysInMonth = Event::publicHolidaysInMonth(
            $start->year, $start->month
        );
        $pluckedPublicHolidaysInMonth = $publicHolidaysInMonth->pluck('start');

        $timePeriodPublicHolidayFilter = Days::publicHolidayFilter(
            $timePeriod, $pluckedPublicHolidaysInMonth
        );
        $timePeriodPublicHolidayFilterCount = $timePeriodPublicHolidayFilter
            ->count();

        $workers = $employer->workers;
        
        $totalWorkingHours = 0;

        foreach ($workers as $worker) {
            $workerEvents = $worker->eventsByTimePeriod1(
                (string) $start, (string) $end, $employer->id
            );
            $absenceInDays = Days::absenceInDays($workerEvents);
            $workingDays = $timePeriod->count() - $absenceInDays;
            $worker->workerEvents = $workerEvents;
            $worker->absenceInDays = $absenceInDays;
            $worker->workingDays = $workingDays;
            $worker->workingHoursDuringMonth = $workingDays * config(
                'record.working_hours_during_day'
            );
            $totalWorkingHours += $worker->workingHoursDuringMonth;
        }

        $legend = Legend::allSortBy();
        
        $calendar = new Calendar;
        $workers = $calendar->addLegendToWorker($legend, $workers);
        $legendCollection = collect($legend);
        $legendGroups = $legendCollection->split(2);

        $data = [
            'employer' => $employer,
            'workers' => $workers,
            'start' => $start->toDateString(),
            'end' => $end->toDateString(),
            'is_future' => $isFuture,
            'month_name' => $monthName,
            'days_in_month' => $daysInMonth,
            'time_period_public_holiday_filter' => 
                $timePeriodPublicHolidayFilterCount,
            'public_holidays_in_month_count' => $publicHolidaysInMonth->count(),
            'absence_in_days' => $absenceInDays,
            'working_days' => $workingDays,
            'previous_month' => $previousMonthStartAsYearMonth,
            'next_month' => $nextMonth,
            // 'admin' => $admin,
            'year_month' => $yearMonth,
            'legend' => $legend,
            'legend_groups' => $legendGroups,
            'totalWorkingHours' => $totalWorkingHours,
        ];

        return $data;
    }
}
