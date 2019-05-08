<?php

namespace App\Http\Controllers\User\Worker\Record;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\{Worker, Employer, Event};
use App\Days;

class Index1Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Worker $worker, Employer $employer, string $year_month)
    {
        $start = Days::start($year_month);  // start period time for which we calculate the statistics

        $monthName = $start->monthName;

        $end = Days::end($monthName, $start);  // current day or end of the month

        $daysInMonth = $start->daysInMonth;  // number of days in a month
        
        $isFuture = $start > Carbon::now();  // whether the user calculates statistics for a future date

        $previousMonthStart = $start->subMonth()->startOfMonth();
        $previousMonthStartAsYearMonth = $previousMonthStart->format('Y-m');
        $nextMonth = $start->addMonth()->format('Y-m');

        $timePeriod = CarbonPeriod::between($start, $end);  // the period of time for which we calculate the statistics

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

        $workerEvents = $worker->eventsByTimePeriod1($start, $end, $employer->id);
        $absenceInDays = Days::absenceInDays($workerEvents);
        $workingDays = $timePeriod->count() - $absenceInDays;

        return view(
            'user.worker.record.index1',
            [
                'worker' => $worker,
                'start' => $start->toDateString(),
                'end' => $end->toDateString(),
                'is_future' => $isFuture,
                'month_name' => $monthName,
                'days_in_month' => $daysInMonth,
                'time_period_public_holiday_filter' => 
                    $timePeriodPublicHolidayFilterCount,
                'public_holidays_in_month' => $publicHolidaysInMonth,
                'absence_in_days' => $absenceInDays,
                'working_days' => $workingDays,
                'previous_month' => $previousMonthStartAsYearMonth,
                'next_month' => $nextMonth,
            ]
        );
    }
}
