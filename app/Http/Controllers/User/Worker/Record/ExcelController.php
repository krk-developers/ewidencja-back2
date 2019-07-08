<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Record;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Exports\{IndividualExport, IndividualData};
use Maatwebsite\Excel\Facades\Excel;
// use Illuminate\Support\Collection;
// use Carbon\Carbon;
// use Carbon\CarbonPeriod;
use App\{Worker, Employer};  // , Legend, Event
// use App\{Days, Calendar};
use App\Record\Individual;

class ExcelController extends Controller
{
    /**
     * Export record to Excel.
     *
     * @param Worker   $worker    Worker
     * @param Employer $employer  Employer
     * @param string   $yearMonth YYYY-MM
     * 
     * @return Response
     */
    public function __invoke(
        Worker $worker,
        Employer $employer,
        string $yearMonth
    ): BinaryFileResponse {
        // $admin = $request->query('admin');
        
        $individualRecord = new Individual;
        $data = $individualRecord->calculate($worker, $employer, $yearMonth);

        $individualData = new IndividualData();
        $preparedData = $individualData->prepare($data, $yearMonth);

        $export = new IndividualExport($preparedData);
        
        $fileName = $worker->user->name. ' ' . $worker->lastname . ' ' . $employer->company . '.xlsx';
        
        return Excel::download($export, $fileName);
    }
}
