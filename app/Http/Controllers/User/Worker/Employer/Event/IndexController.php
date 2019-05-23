<?php

namespace App\Http\Controllers\User\Worker\Employer\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Days, Worker, Employer};

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Worker $worker, Employer $employer, string $year_month)  // Request $request
    {
        // return __CLASS__;
        // pracownicy/{worker}/pracodawcy/{employer}/wydarzenia
        // return $year_month;
        $start = Days::start($year_month);  // start period time for which we calculate the statistics
        $end = $start->endOfMonth();

        $startAsString = $start->toDateString();
        $endAsString = $end->toDateString();
        // return $startAsString;
        $previousMonth = $start->subMonth()->startOfMonth();
        // return $previousMonth;
        $previousMonth = $previousMonth->format('Y-m');
        $nextMonth = $start->addMonth()->format('Y-m');
        // return $previousMonthAsYearMonth;
        // return $end->toDateString();
        // return $worker->id;
        $events = $worker->eventsByEmployerID(
            $employer->id, $startAsString, $endAsString
        );
        // return $events;
        return view(
            'user.worker.employer.event.index',
            [
                'worker' => $worker,
                'employer' => $employer,
                'events' => $events,
                'start' => $startAsString,
                'end' => $endAsString,
                'year_month' => $year_month,
                'previous_month' => $previousMonth,
                'next_month' => $nextMonth,
            ]
        );
    }
}
