<?php

declare(strict_types = 1);

namespace App\Exports;

use App\Exports\CommonData;

class IndividualData
{
    /**
     * Data for Excel
     *
     * @param array  $data      All data to export
     * @param string $yearMonth YYYY-MM
     * 
     * @return array
     */
    public function prepare(array $data, string $yearMonth): array
    {
        $commonData = new CommonData;

        return [
            $this->personalData(),
            [
                $data['name'],
                $data['worker']->pesel,
                $data['employer']->company,
                $yearMonth,
                $data['worker']->equivalent_amount,
                $data['worker']->effective,
            ],
            [''],
            $this->days(),
            [
                $data['days_in_month'],
                $data['working_days'],
                $data['public_holidays_in_month_count'],
                $data['absence_in_days'],
                $data['worker_worked_days'],
                $data['worker_worked_hours'],
            ],
            [''],
            [
                array_keys($data['calendar']),
                array_values($data['calendar']),
            ],
            [''],
            $commonData->signatures(),
            [''],
            [
                $data['legend_names'],
                $data['legend_display_names'],
            ],
        ];
    }

    /**
     * Personal data's row
     *
     * @return array
     */
    private function personalData(): array
    {
        return [
            'Imię i nazwisko',
            'PESEL',
            'Pracodawca',
            'Okres',
            'Kwota ekwiwalentu',
            'Etat efektywny',
        ];
    }

    /**
     * Day's row
     *
     * @return array
     */
    private function days(): array
    {
        return [
            'Dni w miesiącu',
            'Dni pracujących',
            'Dni ustawowo wolnych od pracy',
            'Nieobecności',
            'Przepracowanych dni',
            'Przepracowanych godzin',
        ];
    }
}
