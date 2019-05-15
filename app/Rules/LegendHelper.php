<?php

declare(strict_types = 1);

namespace App\Rules;

use App\Legend;

/**
 * Helper class for Legend rule
 */
class LegendHelper
{
    /**
     * Event's date start and end can not be null
     *
     * @param string|null $start Event's start date
     * @param string|null $end   Event's end date
     * 
     * @return bool|none
     */
    public static function requestIsNotNull(?string $start, ?string $end)
    {
        if ($start == null) {
            return false;
        }
        
        if ($end == null) {
            return false;
        }

        return null;
    }

    /**
     * Find Legend by its primary key
     *
     * @param integer $id Primary key
     * 
     * @return Legend
     */
    public static function findLegend(int $id): Legend
    {
        return Legend::find_($id);
    }
}
