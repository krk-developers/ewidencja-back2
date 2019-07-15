<?php

namespace App\Http\Controllers\User\Employer\Record;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use PDF;
use App\Employer;
use App\Record\{Collective, CollectiveHelper};

/**
 * Collective record
 */
class PDFController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request  $request   Request
     * @param Employer $employer  Employer
     * @param string   $yearMonth YYYY-MM
     * 
     * @return Response
     */
    public function __invoke(
        Request $request,
        Employer $employer,
        string $yearMonth
    ): Response {
        $collectiveRecord = new Collective;
        $data = $collectiveRecord->calculate($employer, $yearMonth);
        $data['admin'] = $request->query('admin');
        
        $pdf = PDF::loadView('user.employer.record.pdf', $data);
        
        $helper = new CollectiveHelper();
        $filename = $helper->filename($employer->company, $yearMonth, 'pdf');
        
        return $pdf->download($filename);
    }
}
