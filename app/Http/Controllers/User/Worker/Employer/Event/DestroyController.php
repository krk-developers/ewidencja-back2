<?php

namespace App\Http\Controllers\User\Worker\Employer\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Worker, Employer, Event};

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Worker $worker, Employer $employer, Event $event, string $year_month)
    {
        return __CLASS__;
    }
}
