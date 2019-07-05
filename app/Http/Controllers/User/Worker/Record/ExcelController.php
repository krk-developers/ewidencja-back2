<?php

namespace App\Http\Controllers\User\Worker\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\{IndividualExport, IndividualData};
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\{Worker, Employer, Legend, Event};
use App\{Days, Calendar};
use App\Record\Individual;

class ExcelController extends Controller
{
    /**
     * Export record to Excel.
     *
     * @param Request  $request    Request
     * @param Worker   $worker     Worker
     * @param Employer $employer   Employer
     * @param string   $year_month YYYY-MM
     * 
     * @return Response
     */
    public function __invoke(
        Request $request,
        Worker $worker,
        Employer $employer,
        string $year_month
    ) {
        $admin = $request->query('admin');
        
        $individualRecord = new Individual;
        $data = $individualRecord->calculate($worker, $employer, $year_month);
        // dd($data);

        $individualData = new IndividualData();
        $preparedData = $individualData->prepare($data, $year_month);
        // dd($preparedData);

        $export = new IndividualExport($preparedData);
        
        $fileName = $worker->user->name. ' ' . $worker->lastname . ' ' . $employer->company;
        // . ' ' . $yearMonth;
        $fileName .= '.xlsx';
        
        return Excel::download($export, $fileName);
    }
}
