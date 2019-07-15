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
        $publicHolidays = Event::publicHolidaysInMonth(
            $start->year, $start->month
        );
        $publicHolidaysCount = $publicHolidays->count();
        $pPublicHolidays = $publicHolidays->pluck('start');

        $workingDays = Days::publicHolidayFilter(
            $timePeriod, $pPublicHolidays
        );
        $workingDaysCount = $workingDays->count();

        $workers = $employer->workers;
        
        //
        $totalWorkedHours = $totalWorkedDays = $totalAbsenceDays = 0;

        foreach ($workers as $worker) {
            $workerEvents = $worker->eventsByTimePeriod1(
                (string) $start, (string) $end, $employer->id
            );
            $absenceInDays = Days::absenceInDays($workerEvents);
            $workedDays = $timePeriod->count() - $absenceInDays;
            $worker->worker_events = $workerEvents;
            $worker->absence_days = $absenceInDays;
            $worker->worked_days = $workedDays;
            $worker->worked_hours = $workedDays * config(
                'record.working_hours_during_day'
            );

            $totalWorkedHours += $worker->worked_hours;
            $totalWorkedDays += $workedDays;
            $totalAbsenceDays += $absenceInDays;
        }
        //

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
            'working_days' => $workingDaysCount,
            'public_holidays' => $publicHolidays,
            'public_holidays_count' => $publicHolidaysCount,
            'total_absence_days' => $totalAbsenceDays,
            'previous_month' => $previousMonthStartAsYearMonth,
            'next_month' => $nextMonth,
            'year_month' => $yearMonth,
            'legend' => $legend,
            'legend_groups' => $legendGroups,
            'total_worked_hours' => $totalWorkedHours,
            'total_worked_days' => $totalWorkedDays,
        ];

        return $data;
    }
}
