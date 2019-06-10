<?php

namespace App\Http\Controllers\User\Employer\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Carbon\{Carbon, CarbonPeriod};
use App\{Employer, Event, Days};

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Employer $employer   Employer
     * @param string   $year_month Year and month. YYYY-MM
     * 
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Employer $employer, string $year_month): View
    {
        // return __CLASS__;

        $admin = $request->query('admin');

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

        // $workers = Employer::workersByEmployerID($employer->id);
        $workers = $employer->workers;
        // return $workers;
        
        
        foreach ($workers as $worker) {
            $workerEvents = $worker->eventsByTimePeriod1($start, $end, $employer->id);
            $absenceInDays = Days::absenceInDays($workerEvents);
            $workingDays = $timePeriod->count() - $absenceInDays;
            
            $worker->workerEvents = $workerEvents;
            $worker->absenceInDays = $absenceInDays;
            $worker->workingDays = $workingDays;
        }
        
        // return $workers;

        /*
        $events = Employer::workersWithEventsByEmployerID(
            $employer->id, $start_, $end_
        );
        return $events;
        */
        return view(
            'user.employer.record.index',
            [
                'employer' => $employer,
                'workers' => $workers,
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
                'admin' => $admin,
            ]
        );
    }
}
