<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\{Worker, Employer, Event};
use App\Days;
use App\Http\Traits\Record;

class IndexController extends Controller
{
    use Record;

    /**
     * Show user's record
     *
     * @param Request  $request    Request
     * @param Worker   $worker     Worker
     * @param Employer $employer   Employer
     * @param string   $year_month Year and month. Format YYYY-MM
     * 
     * @return View
     */
    public function __invoke(
        Request $request,
        Worker $worker,
        Employer $employer,
        string $year_month
    ): View {
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

        $workerEvents = $worker->eventsByTimePeriod1((string) $start, (string) $end, $employer->id);
        //dd($workerEvents);
        $absenceInDays = Days::absenceInDays($workerEvents);
        $workingDays = $timePeriod->count() - $absenceInDays;
        $workingHoursDuringMonth = $workingDays * config(
            'record.working_hours_during_day'
        );

        return view(
            'user.worker.record.index',
            [
                'worker' => $worker,
                'employer' => $employer,
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
                'workingHoursDuringMonth' => $workingHoursDuringMonth,
                'previous_month' => $previousMonthStartAsYearMonth,
                'next_month' => $nextMonth,
                'admin' => $admin,
                'year_month' => $year_month,
            ]
        );
    }
}
