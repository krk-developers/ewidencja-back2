<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\{Worker, Event};
use App\Days;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Worker $worker, $year_month)//: View
    {
        // return $period;
        $start = Days::start($year_month);
        // dd($start);
        $monthName = $start->monthName;
        $end = Days::end($monthName, $start);
        // dd($end);
        $daysInMonth = $start->daysInMonth;
        // dd($daysInMonth);
        $isFuture = $start > Carbon::now();
        
        $previousMonthStart = $start->subMonth()->startOfMonth();
        $previousMonthStartAsYearMonth = $previousMonthStart->format('Y-m');
        // $previousMonthEnd = $previousMonthStart->endOfMonth(); 

        $nextMonth = $start->addMonth()->format('Y-m');

        $timePeriod = CarbonPeriod::between($start, $end);
        // dd($timePeriod);
        /*
        $weekendFilter = function ($date) {
            return $date->isWeekday();  // isWeekend();
        };
        $timePeriod->filter($weekendFilter)->count();  // $timePeriodWeekendFilter
        */

        $timePeriod = Days::weekendFilter($timePeriod);
        // return $timePeriod->count();

        $publicHolidaysInMonth = Event::publicHolidaysInMonth(
            $start->year, $start->month
        );
        $pluckedPublicHolidaysInMonth = $publicHolidaysInMonth->pluck('start');
        // return $pluckedPublicHolidaysInMonth;
        // dd($pluckedPublicHolidaysInMonth);
        // return $pluckedPublicHolidaysInMonth;
        // $pluckedPublicHolidaysInMonth = $publicHolidaysInMonth->pluck('start');

        /*
        $publicHolidays = Event::publicHolidays(Carbon::now()->year);
        $pluckedPublicHolidays = $publicHolidays->pluck('start');
        */
        /*
        $publicHolidayFilter = function ($value) use ($pluckedPublicHolidaysInMonth) {
            return ! in_array(
                $value->format('Y-m-d'),
                $pluckedPublicHolidaysInMonth->toArray()
            );
        };
        $timePeriodPublicHolidayFilter = $timePeriod->filter($publicHolidayFilter);
        */
        // pr($timePeriod);
        // return $pluckedPublicHolidaysInMonth;
        $timePeriodPublicHolidayFilter = Days::publicHolidayFilter(
            $timePeriod, $pluckedPublicHolidaysInMonth
        );
        $timePeriodPublicHolidayFilterCount = $timePeriodPublicHolidayFilter
            ->count();
        // pr($timePeriodPublicHolidayFilter);
        // return $timePeriodPublicHolidayFilterCount;

        $workerEvents = $worker->eventsByTimePeriod($start, $end);  // $worker->events;
        // return $workerEvents;
        // dd($workerEvents);
        // '2019-04-01', '2019-04-31'
        
        /*
        $absenceInDays = 0;
        foreach ($workerEvents as $event) {
            $absencePeriod = CarbonPeriod::between($event->start, $event->end);
            $absenceInDays += $absencePeriod->count();
        }
        */
        
        $absenceInDays = Days::absenceInDays($workerEvents);
        // return $absenceInDays;
        // return $timePeriod->count();
        $workingDays = $timePeriod->count() - $absenceInDays;
        // return $workingDays;

        return view(
            'user.worker.record.index',
            [
                'worker' => $worker,
                'start' => $start->toDateString(),
                'end' => $end->toDateString(),
                'is_future' => $isFuture,
                'month_name' => $monthName,
                'days_in_month' => $daysInMonth,
                // 'time_period_weekend_filter' => $timePeriodWeekendFilter,
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
