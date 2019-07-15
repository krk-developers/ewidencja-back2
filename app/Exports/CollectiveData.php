<?php

declare(strict_types = 1);

namespace App\Exports;

use Illuminate\Support\Collection;

/**
 * Export collective record to spreadsheet
 */
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
            $this->days($data),
            $this->gap(),
            $workerDescription->concat($legend),
            $this->workers($data['workers']),
            $this->hours($data),
            $this->gap(),
            $this->gap(),
            $this->signatures(),
            $this->gap(),
            ['Legenda'],
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
     * Summary of days.
     *
     * @param array $data Data
     * 
     * @return array
     */
    private function days(array $data): array
    {
        return [
            $data['days_in_month'],
            $data['working_days'],
            $data['public_holidays_count'],
            $data['total_absence_days'],
            $data['total_worked_days'],
        ];
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
            $worker['worked_hours'] = $item->worked_hours;

            foreach ($item['legend'] as $key => $value) {
                $worker[$key] = $value;
            }

            $workers[] = $worker;
        }

        return collect($workers);
    }

    private function hours(array $data): array
    {
        return ['', '', '', '', '', '', $data['total_worked_hours']];
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
            'Suma nieobecności',
            'Suma dni przepracowanych',
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
