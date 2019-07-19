<?php

namespace App\Http\Controllers\User\Worker\Employer\Event;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Worker, Employer, Event, Legend};

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Worker   $worker    Worker
     * @param Employer $employer  Employer
     * @param Event    $event     Event
     * @param string   $yearMonth Year and month YYYY-MM
     * 
     * @return View
     */
    public function __invoke(
        Worker $worker,
        Employer $employer,
        Event $event,
        string $yearMonth
    ): View {
        return view(
            'user.worker.employer.event.edit',
            [
                'worker' => $worker,
                'employer' => $employer,
                'event' => $event,
                'year_month' => $yearMonth,
                'legends' => Legend::allSortBy(),
            ]
        );
    }
}
