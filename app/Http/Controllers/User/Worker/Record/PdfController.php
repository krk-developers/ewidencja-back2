<?php

namespace App\Http\Controllers\User\Worker\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\{Worker, Employer, Legend, Event};
use App\{Days, Calendar};

class PdfController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Worker $worker, Employer $employer, string $year_month)
    {
        return __CLASS__;
    }
}
