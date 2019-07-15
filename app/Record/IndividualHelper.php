<?php

declare(strict_types = 1);

namespace App\Record;

use App\{Worker, Employer};

class IndividualHelper
{
    /**
     * Builds the file name.
     *
     * @param string $name      First name
     * @param string $lastname  Last name
     * @param string $company   Company name
     * @param string $yearMonth YYYY-MM
     * @param string $extension File extension
     * 
     * @return string
     */
    public function filename(
        string $name,
        string $lastname,
        string $company,
        string $yearMonth,
        string $extension
    ): string {
        $filename = $name . 
            '-' . 
            $lastname . 
            '-' . 
            $company . 
            '-' . 
            $yearMonth .
            '.' .
            $extension;

        return $filename;
    }
}
