<?php

declare(strict_types = 1);

namespace App\Record;

use App\Employer;

class CollectiveHelper
{
    /**
     * Sets the file name.
     *
     * @param string $companyName Company name
     * @param string $yearMonth   YYYY-MM
     * @param string $extension   File extension
     * 
     * @return string
     */
    public function filename(
        string $companyName,
        string $yearMonth,
        string $extension
    ): string {
        return $companyName . '-' . $yearMonth . '.' . $extension;
    }
}
