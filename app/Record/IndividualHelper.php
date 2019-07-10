<?php

declare(strict_types = 1);

namespace App\Record;

use App\{Worker, Employer};

class IndividualHelper
{
    /**
     * Builds the file name.
     *
     * @param Worker   $worker    Worker
     * @param Employer $employer  Employer
     * @param string   $yearMonth YYYY-MM
     * @param string   $extension File extension
     * 
     * @return string
     */
    public function filename(
        Worker $worker,
        Employer $employer,
        string $yearMonth,
        string $extension = ''
    ): string {
        $str = $worker->user->name . 
            ' ' . 
            $worker->lastname . 
            ' ' . 
            $employer->company . 
            ' ' . 
            $yearMonth;

        if ($extension != '') {
            $str .= '.';
            $str .= $extension;
        }

        return $str;
    }
}
