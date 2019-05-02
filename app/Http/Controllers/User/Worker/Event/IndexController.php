<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\{Event, Worker, Days};

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Worker $worker)//: View  // Request $request, 
    {
        $pluckedEvents = $worker->events->pluck('start');
        // return $pluckedEvents;
        $pluckedPublicHolidays = Event::publicHolidays()->pluck('start');
        // $pluckedPublicHolidays = Days::pluck($publicHolidays);


        $previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
        // return $previousMonthStart;
        $previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        // return $previousMonthEnd;
        $timePeriod = Days::createTimePeriod(
            Carbon::now()->startOfMonth(),
            Carbon::now()            
            /*
            $previousMonthStart,
            $previousMonthEnd
            */
        );

        $timePeriod = Days::weekendFilter($timePeriod);
        // return $timePeriod->count();
        $timePeriod = Days::workerEventFilter($timePeriod, $pluckedEvents);

        $timePeriod = Days::publicHolidayFilter(
            $timePeriod,
            $pluckedPublicHolidays
        );

        // return $timePeriod->count();
        // $now = Carbon::now();
        // return $now->toDateString();
        // return $now->monthName;
        // return $now->month;
        // return $now->subMonth()->startOfMonth();
        // return $now->subMonth()->endOfMonth();

        /*
        $weekendFilter = function ($date) {
            return $date->isWeekday();  // isWeekend();
        };
        $timePeriod->filter($weekendFilter);
        */

        return view(
            'user.worker.event.index',
            [
                'worker' => $worker,
                'worked_days' => $timePeriod->count(),
            ]
        );
    }
}
