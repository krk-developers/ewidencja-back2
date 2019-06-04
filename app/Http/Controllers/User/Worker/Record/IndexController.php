<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Record;

// use Illuminate\Http\Request;
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
     * @param Worker   $worker     Worker
     * @param Employer $employer   Employer
     * @param string   $year_month Year and month. Format YYYY-MM
     * 
     * @return View
     */
    public function __invoke(Worker $worker, Employer $employer, string $year_month)//: View
    {
        // return $worker;
        // return $year_month;
        // return __CLASS__;
        
        $start = $this->periodStart($year_month); // Days::start($year_month);  // start period time for which we calculate the statistics
        // dd($start);

        $monthName = $start->monthName;
        // dd($monthName);
        $end = $this->periodEnd($monthName, $start);  // Days::end($monthName, $start);  // current day or end of the month
        // dd($end);
        $daysInMonth = $start->daysInMonth;  // number of days in a month
        // dd($daysInMonth);
        $isFuture = $start > Carbon::now();  // whether the user calculates statistics for a future date
        
        // $previousMonthStart = $start->subMonth()->startOfMonth();
        $previousMonthStartAsYearMonth = $this->previousMonthStartAsYearMonth($start);  //$previousMonthStart->format('Y-m');
        // dd($previousMonthStartAsYearMonth);
        $nextMonth = $start->addMonth()->format('Y-m');
        // dd($nextMonth);
        
        $timePeriod = CarbonPeriod::between($start, $end);  // the period of time for which we calculate the statistics

        $timePeriod = Days::weekendFilter($timePeriod);
        
        /*
        // number of public holidays in a month
        $publicHolidaysInMonth = Event::publicHolidaysInMonth(
            $start->year, $start->month
        );
        $pluckedPublicHolidaysInMonth = $publicHolidaysInMonth->pluck('start');
        */
        $publicHolidaysInMonth = $this->publicHolidaysInMonth($start);
        // dd($publicHolidaysInMonth);

        /*
        $timePeriodPublicHolidayFilter = Days::publicHolidayFilter(
            $timePeriod, $pluckedPublicHolidaysInMonth
        );
        $timePeriodPublicHolidayFilterCount = $timePeriodPublicHolidayFilter
            ->count();
        */
        $timePeriodPublicHolidayFilterCount = $this->timePeriodPublicHolidayFilterCount(
            $timePeriod, $publicHolidaysInMonth
        );
        // dd($timePeriodPublicHolidayFilterCount);
        
        /*
        $workerEvents = $worker->eventsByTimePeriod1(
            (string) $start, (string) $end, $employer->id
        );
        $absenceInDays = Days::absenceInDays($workerEvents);
        */
        $absenceInDays = $this->absenceInDays($worker, $employer, $start, $end);
        // dd($absenceInDays);

        $workingDays = $timePeriod->count() - $absenceInDays;
        
        // $this->calculate($worker, $employer, $year_month);

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
                'previous_month' => $previousMonthStartAsYearMonth,
                'next_month' => $nextMonth,
            ]
        );
    }
}
