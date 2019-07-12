<?php

namespace App\Http\Controllers\User\Employer\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Carbon\{Carbon, CarbonPeriod};
use App\{Employer, Event, Days};
use App\Record\Collective;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param equest   $request   Request 
     * @param Employer $employer  Employer
     * @param string   $yearMonth Year and month. YYYY-MM
     * 
     * @return View
     */
    public function __invoke(
        Request $request,
        Employer $employer,
        string $yearMonth
    ): View {   
        $collectiveRecord = new Collective;
        $data = $collectiveRecord->calculate($employer, $yearMonth);
        $data['admin'] = $request->query('admin');

        return view('user.employer.record.index', $data);
    }
}
