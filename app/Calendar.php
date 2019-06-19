<?php

declare(strict_types = 1);

namespace App;

// use Carbon\Carbon;
use Illuminate\Support\Collection;
use Carbon\CarbonPeriod;
use App\Days;

class Calendar
{
    public function make(
        Collection $workerEvents,
        CarbonPeriod $timePeriod,
        Collection $pluckedPublicHolidaysInMonth
    ): array {
        $workerEventsAsPeriod = $this->workerEventsPeriod($workerEvents);

        $dates = [];
        foreach ($timePeriod as $date) {
            $isPublicHoliday = Days::isPublicHoliday(
                $date, $pluckedPublicHolidaysInMonth->toArray()
            );
            
            $isworkerEvent = false;
            $legendName = '';
            foreach ($workerEventsAsPeriod as $event) {
                if ($date->between($event['period']->getStartDate(), $event['period']->getEndDate())) {
                    $isworkerEvent = true;
                    $legendName = $event['legend'];
                }
            }

            if ($date->isWeekend()) {
                $dates[$date->format('d')] = 'Ś';
            } elseif ($isPublicHoliday) {
                $dates[$date->format('d')] = 'DZUW';
            } elseif ($isworkerEvent) {
                $dates[$date->format('d')] = $legendName;
            } else {
                $dates[$date->format('d')] = 'DP';
            }
        }

        return $dates;
    }

    /**
     * Creates an employee event array.
     *
     * @param Collection $workerEvents Workers's events
     * 
     * @return array
     */
    private function workerEventsPeriod(Collection $workerEvents): array
    {
        $workerEventsAsPeriod = [];

        foreach ($workerEvents as $event) {
            $period = new CarbonPeriod($event->start, $event->end);
            $eventPeriod = [];
            $eventPeriod['legend'] = $event->legend_name;
            $eventPeriod['period'] = $period;
            $workerEventsAsPeriod[] = $eventPeriod;  // $period;
        }
        
        return $workerEventsAsPeriod;
    }
}
