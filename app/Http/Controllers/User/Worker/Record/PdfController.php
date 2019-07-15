<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Record;

use App\Http\Controllers\Controller;
use App\{Worker, Employer};
use PDF;
use App\Record\{Individual, IndividualHelper};

class PdfController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Worker   $worker    Worker
     * @param Employer $employer  Employer
     * @param string   $yearMonth YYYY-MM
     * 
     * @return object
     */
    public function __invoke(
        Worker $worker,
        Employer $employer,
        string $yearMonth
    ): object {
        $individualRecord = new Individual;
        $data = $individualRecord->calculate($worker, $employer, $yearMonth);

        $pdf = PDF::loadView('user.worker.record.pdf', $data);
        
        $helper = new IndividualHelper();
        $filename = $helper->filename(
            $worker->user->name,
            $worker->lastname,
            $employer->company,
            $yearMonth,
            'pdf'
        );

        return $pdf->download($filename);
    }
}
