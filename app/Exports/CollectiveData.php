<?php

namespace App\Exports;

use Illuminate\Support\Collection;

class CollectiveData
{
    public function prepare(array $data, string $yearMonth): array  // array $data, string $yearMonth
    {
        // dd($data);
        $workers = $this->workers($data['workers']);
        // dd($workers);
        $workerDescription = $this->workerDescription();
        // dd($workerDescription->count());
        $legend = $this->legend($data['legend'], $workerDescription->count());
        // dd($data['legend']);
        $workerDescriptionAndLegend = $workerDescription->concat($legend);
        // dd($workerDescriptionAndLegend);
        $daysDescription = $this->daysDescription();
        $signatures = $this->signatures();
        $legend1 = $this->legend1($data['legend']);
        // dd($legend1);

        return  [
            ['Pracodawca', 'Okres'],
            [$data['employer']->company, $yearMonth],
            [''],
            $daysDescription,
            [
                $data['days_in_month'],
                $data['time_period_public_holiday_filter'],
                $data['public_holidays_in_month_count'],
                $data['absence_in_days'],
                $data['working_days'],
            ],
            [''],
            $workerDescriptionAndLegend,
            $workers,
            [''],
            $signatures,
            [''],
            $legend1['legendNames'],
            $legend1['legendDisplayNames'],
        ];
    }

    private function workers(Collection $data): Collection
    {
        $workers = [];

        foreach ($data as $item) {
            $worker = [];
            $worker['name'] = $item->user->name;
            $worker['lastname'] = $item->lastname;
            $worker['pesel'] = $item->pesel;
            $worker['equivalent'] = $item->equivalent;
            $worker['equivalent_amount'] = $item->equivalent_amount;
            $worker['effective'] = $item->effective;
            $worker['workingHoursDuringMonth'] = $item->workingHoursDuringMonth;

            foreach ($item['legend'] as $key => $value) {
                $worker[$key] = $value;
            }

            $workers[] = $worker;
        }

        return collect($workers);
    }

    private function legend(Collection $collection, int $index): Collection
    {
        $legend = [];

        foreach ($collection as $item) {
            $legend[$index] = $item->name;
            $index++;
        }

        return collect($legend);
    }

    private function workerDescription()
    {
        return collect(
            [
                'Imię',
                'Nazwisko',
                'PESEL',
                'Ekwiwalent',
                'Kwota',
                'Etat',
                'Suma godz.',
            ]
        );
    }

    private function daysDescription()
    {
        return [
            'Dni w miesiącu',
            'Dni pracujących',
            'Dni ustawowo wolnych od pracy',
            'Nieobecności',
            'Dni przepracowanych',
        ];
    }

    private function signatures()
    {
        return [
            'Podpis doradcy zawodowego',
            '',
            'Podpis pracownika działu kadr',
            '',
            'Podpis koordynatora',
        ];
    }

    private function legend1($data)
    {        
        $legendNames = [];
        $legendDisplayNames = [];

        foreach ($data as $item) {
            $legendNames[] = $item->name;
            $legendDisplayNames[] = $item->display_name;
        }

        return [
            'legendNames' => $legendNames,
            'legendDisplayNames' => $legendDisplayNames,
        ];
        // dd($legendNames);
        // dd($legendDisplayNames);
    }
}
