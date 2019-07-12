<?php

namespace App\Http\Controllers\User\Employer\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Employer;
use App\Record\Collective;

class PrintController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request  $request   Request
     * @param Employer $employer  Employer
     * @param string   $yearMonth YYYY-MM
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
        
        return view('user.employer.record.print', $data);
    }
}
