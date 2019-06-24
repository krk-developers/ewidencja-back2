<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\{Worker, Employer, Legend, Event};
use App\{Days, Calendar};

class PrintController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request  $request    Request
     * @param Worker   $worker     Worker
     * @param Employer $employer   Employer
     * @param string   $year_month YYYY-MM
     * 
     * @return Response
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

        $legend = Legend::allSortBy();
        $legendCollection = collect($legend);
        $legendGroups = $legendCollection->split(2);
        
        return view(
            'user.worker.record.print1',
            [
                'worker' => $worker,
                'employer' => $employer,
                'yearMonth' => $yearMonth,
                'days_in_month' => $daysInMonth,
                'time_period_public_holiday_filter' => 
                    $timePeriodPublicHolidayFilterCount,
                'public_holidays_in_month' => $publicHolidaysInMonth,
                'absence_in_days' => $absenceInDays,
                'working_days' => $workingDays,
                'workingHoursDuringMonth' => $workingHoursDuringMonth,
                'events' => $workerEvents,
                'calendar' => $workerCalendar,
                'legend_groups' => $legendGroups,
            ]
        );
    }
}
