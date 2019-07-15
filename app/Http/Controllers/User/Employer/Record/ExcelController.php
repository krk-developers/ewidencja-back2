<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer\Record;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Exports\{CollectiveExport, CollectiveData};
use Maatwebsite\Excel\Facades\Excel;
use App\Employer;
use App\Record\{Collective, CollectiveHelper};

class ExcelController extends Controller
{
    /**
     * Export collective records to Excel
     *
     * @param Employer $employer  Employer
     * @param string   $yearMonth YYYY-MM
     * 
     * @return Response
     */
    public function __invoke(
        Employer $employer,
        string $yearMonth
    ): BinaryFileResponse {
        $collectiveRecord = new Collective;
        $data = $collectiveRecord->calculate($employer, $yearMonth);
        
        $collectiveData = new CollectiveData();
        $preparedData = $collectiveData->prepare($data, $yearMonth);

        $export = new CollectiveExport($preparedData);

        $helper = new CollectiveHelper();
        $filename = $helper->filename($employer->company, $yearMonth, 'xlsx');

        return Excel::download($export, $filename);
    }
}
