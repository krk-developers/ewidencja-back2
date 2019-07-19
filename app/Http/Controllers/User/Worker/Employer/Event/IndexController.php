<?php

namespace App\Http\Controllers\User\Worker\Employer\Event;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Days, Worker, Employer};

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Worker   $worker    Worker
     * @param Employer $employer  Employer
     * @param string   $yearMonth YYYY-MM
     * 
     * @return View
     */
    public function __invoke(
        Worker $worker,
        Employer $employer,
        string $yearMonth
    ): View {
        // start period time for which we calculate the statistics
        $start = Days::start($yearMonth);
        $end = $start->endOfMonth();

        $startAsString = $start->toDateString();
        $endAsString = $end->toDateString();        
        $previousMonth = $start->subMonth()->startOfMonth();
        $previousMonth = $previousMonth->format('Y-m');
        $nextMonth = $start->addMonth()->format('Y-m');

        $events = $worker->eventsByEmployerID(
            $employer->id, $startAsString, $endAsString
        );

        return view(
            'user.worker.employer.event.index',
            [
                'worker' => $worker,
                'employer' => $employer,
                'events' => $events,
                'start' => $startAsString,
                'end' => $endAsString,
                'year_month' => $yearMonth,
                'previous_month' => $previousMonth,
                'next_month' => $nextMonth,
            ]
        );
    }
}
