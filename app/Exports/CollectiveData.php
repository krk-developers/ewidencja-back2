<?php

declare(strict_types = 1);

namespace App\Exports;

use Illuminate\Support\Collection;

class CollectiveData
{
    /**
     * Prepare date for spreadsheet.
     *
     * @param array  $data      Data
     * @param string $yearMonth YYYY-MM
     * 
     * @return array
     */
    public function prepare(array $data, string $yearMonth): array
    {
        $workerDescription = $this->workerDescription();
        $legend = $this->legend($data['legend'], $workerDescription->count());

        return  [
            ['Pracodawca', 'Okres'],
            [$data['employer']->company, $yearMonth],
            $this->gap(),
            $this->daysDescription(),
            [
                $data['days_in_month'],
                $data['working_days'],
                $data['public_holidays_count'],
                $data['absence_in_days'],
                $data['working_days'],
            ],
            $this->gap(),
            $workerDescription->concat($legend),
            $this->workers($data['workers']),
            $this->gap(),
            $this->gap(),
            $this->signatures(),
            $this->gap(),
            $this->legendNames($data['legend'])['legendNames'],
            $this->legendNames($data['legend'])['legendDisplayNames'],
        ];
    }

    /**
     * Gap between columns.
     *
     * @return array
     */
    private function gap(): array
    {
        return [[''], [''], [''], ['']];
    }
    
    /**
     * Prepare worker's collection
     *
     * @param Collection $data Workers
     * 
     * @return Collection
     */
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

    /**
     * Prepare legend's collection.
     *
     * @param Collection $collection Legend's collection
     * @param integer    $index      Start index
     * 
     * @return Collection
     */
    private function legend(Collection $collection, int $index): Collection
    {
        $legend = [];

        foreach ($collection as $item) {
            $legend[$index] = $item->name;
            $index++;
        }

        return collect($legend);
    }

    /**
     * Columns about worker.
     *
     * @return Collection
     */
    private function workerDescription(): Collection
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

    /**
     * Columns about days.
     *
     * @return array
     */
    private function daysDescription(): array
    {
        return [
            'Dni w miesiącu',
            'Dni pracujących',
            'Dni ustawowo wolnych od pracy',
            'Nieobecności',
            'Dni przepracowanych',
        ];
    }

    /**
     * Signatures.
     *
     * @return array
     */
    private function signatures(): array
    {
        return [
            'Podpis doradcy zawodowego',
            '',
            'Podpis pracownika działu kadr',
            '',
            'Podpis koordynatora',
        ];
    }

    /**
     * Seperate legend's short and long names
     *
     * @param array $data Collection
     * 
     * @return array
     */
    private function legendNames(Collection $data): array
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
    }
}
