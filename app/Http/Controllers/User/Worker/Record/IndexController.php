<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Worker, Employer};
use App\Http\Traits\Record;
use App\Record\Individual;

class IndexController extends Controller
{
    use Record;

    /**
     * Show user's record
     *
     * @param Request  $request   Request
     * @param Worker   $worker    Worker
     * @param Employer $employer  Employer
     * @param string   $yearMonth Year and month. Format YYYY-MM
     * 
     * @return View
     */
    public function __invoke(
        Request $request,
        Worker $worker,
        Employer $employer,
        string $yearMonth
    ): View {
        $admin = $request->query('admin');
        
        $individualRecord = new Individual;
        $data = $individualRecord->calculate($worker, $employer, $yearMonth);
        $data['admin'] = $admin;

        return view('user.worker.record.index', $data);
    }
}
