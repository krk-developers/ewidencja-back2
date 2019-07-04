<?php

namespace App\Http\Controllers\User\Employer\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\{CollectiveExport, CollectiveData};
use Maatwebsite\Excel\Facades\Excel;
use App\Employer;
use App\Record\Collective;

class ExcelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Employer $employer, string $year_month)
    {
        // return __CLASS__;
        // $admin = $request->query('admin');
        // dd($admin);
        $collectiveRecord = new Collective;
        // echo $collectiveRecord;
        $data = $collectiveRecord->calculate($employer, $year_month);
        // dd($data);
        // $data1 = $collectiveRecord->prepareData($data, $year_month);
        // dd($data1);
        $collectiveData = new CollectiveData();
        $preparedData = $collectiveData->prepare($data, $year_month);
        // dd($preparedData);

        $export = new CollectiveExport($preparedData);
        // dd($export->prepareData());

        $fileName = 'collective.xlsx';
        return Excel::download($export, $fileName);
    }
}
