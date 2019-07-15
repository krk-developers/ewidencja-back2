<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Record;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Exports\{IndividualExport, IndividualData};
use Maatwebsite\Excel\Facades\Excel;
use App\{Worker, Employer};
use App\Record\{Individual, IndividualHelper};

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
        $individualRecord = new Individual;
        $data = $individualRecord->calculate($worker, $employer, $yearMonth);
        
        $individualData = new IndividualData();
        $preparedData = $individualData->prepare($data, $yearMonth);

        $export = new IndividualExport($preparedData);
        
        $helper = new IndividualHelper();
        $filename = $helper->filename(
            $worker->user->name,
            $worker->lastname,
            $employer->company,
            $yearMonth,
            'xlsx'
        );
        
        return Excel::download($export, $filename);
    }
}
