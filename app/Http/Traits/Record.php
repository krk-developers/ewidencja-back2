<?php

declare(strict_types = 1);

namespace App\Http\Traits;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use App\{Worker, Employer, Event};
use App\Days;

trait Record
{
    public function periodStart(string $year_month): CarbonImmutable
    {
        // start period time for which we calculate the statistics
        $start = Days::start($year_month);

        return $start;
    }

    public function periodEnd(string $monthName, CarbonImmutable $start): object // Carbon|CarbonImmutable
    {
        return Days::end($monthName, $start);
    }

    public function previousMonthStartAsYearMonth(CarbonImmutable $start): string
    {
        $previousMonthStart = $start->subMonth()->startOfMonth();
        $previousMonthStartAsYearMonth = $previousMonthStart->format('Y-m');

        return $previousMonthStartAsYearMonth;
    }

    public function publicHolidaysInMonth(CarbonImmutable $start): Collection
    {
        $publicHolidaysInMonth = Event::publicHolidaysInMonth(
            $start->year, $start->month
        );
        $pluckedPublicHolidaysInMonth = $publicHolidaysInMonth->pluck('start');

        return $publicHolidaysInMonth;
        /*
        return [
            'publicHolidaysInMonth' => $publicHolidaysInMonth,
            'pluckedPublicHolidaysInMonth' => $pluckedPublicHolidaysInMonth,
        ];*/
    }

    public function timePeriodPublicHolidayFilterCount(
        CarbonPeriod $timePeriod, Collection $pluckedPublicHolidaysInMonth
    ): int {
        // dd($timePeriod);
        // dd($pluckedPublicHolidaysInMonth);
        $timePeriodPublicHolidayFilter = Days::publicHolidayFilter(
            $timePeriod, $pluckedPublicHolidaysInMonth
        );
        $timePeriodPublicHolidayFilterCount = $timePeriodPublicHolidayFilter
            ->count();

        return $timePeriodPublicHolidayFilterCount;
    }

    // Carbon|CarbonImmutable $start
    public function absenceInDays(Worker $worker, Employer $employer, CarbonImmutable $start, object $end): int
    {
        // dd($end);
        $workerEvents = $worker->eventsByTimePeriod1(
            (string) $start, (string) $end, $employer->id
        );
        // dd($workerEvents);
        $absenceInDays = Days::absenceInDays($workerEvents);

        return $absenceInDays;
    }

    /*
    public function calculate(Worker $worker, Employer $employer, string $year_month)
    {
        $start = Days::start($year_month);  // start period time for which we calculate the statistics
        // dd($start);
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

        //dd($employer->id);
        $workerEvents = $worker->eventsByTimePeriod1(
            (string) $start, (string) $end, $employer->id
        );
        $absenceInDays = Days::absenceInDays($workerEvents);
        $workingDays = $timePeriod->count() - $absenceInDays;
    }
    */
}