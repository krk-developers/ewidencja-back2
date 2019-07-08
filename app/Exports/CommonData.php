<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use App\Legend;

class CommonData
{
    /**
     * Seperate legend's short name and long nane.
     *
     * @param Collection $legend Legend
     * 
     * @return array
     */
    public function seperateLegend(Collection $legend): array
    {
        $legendNames = [];
        $legendDisplayNames = [];

        foreach ($legend as $item) {
            $legendNames[] = $item->name;
            $legendDisplayNames[] = $item->display_name;
        }

        return [
            'legendNames' => $legendNames,
            'legendDisplayNames' => $legendDisplayNames,
        ];
    }

    /**
     * Signature's row
     *
     * @return array
     */
    public function signatures(): array
    {
        return [
            'Podpis doradcy zawodowego',
            '',
            'Podpis pracownika działu kadr',
            '',
            'Podpis koordynatora',
        ];
    }
}
