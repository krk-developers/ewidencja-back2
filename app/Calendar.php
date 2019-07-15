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
            $workerEventsAsPeriod[] = $eventPeriod;
        }
        
        return $workerEventsAsPeriod;
    }

    public function addLegendToWorker(Collection $legend, Collection $workers)
    {
        foreach ($workers as $worker) {
            $workerLegend = [];

            foreach ($legend as $l) {
                $eventExists = false;
                $eventDayCount = 0;

                foreach ($worker->worker_events as $event) {
                    if ($l->id == $event->legend_id) {
                        $eventExists = true;
                        $period = new CarbonPeriod($event->start, $event->end);
                        $eventDayCount = $period->count();
                    }
                }

                if ($eventExists) {
                    $workerLegend[$l->name] = $eventDayCount;
                } else {
                    $workerLegend[$l->name] = $eventDayCount;
                }
            }

            $worker->legend = $workerLegend;
        }

        return $workers;
    }

    private function event($event)
    {
        $period = new CarbonPeriod($event->start, $event->end);
        $eventDayCount = $period->count();

        return [$event->legend_name => $eventDayCount];
    }
    
    private function worker($worker)
    {
        $events = array_map(
            array($this, 'event'), $worker['workerEvents']->toArray()
        );
     
        return $events;
    }
    
    public function addLegendToWorker1(Collection $legend, Collection $workers)
    {
        /*
        $events = array_map(array($this, 'worker'), $workers->toArray());
        array_map(array($this, 'legend'), $legend->toArray(), $events);

        return [];
        */
    }
}
