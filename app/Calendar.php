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

    public function addLegendToWorker(Collection $legend, Collection $workers)
    {
        foreach ($workers as $worker) {
            $workerLegend = [];

            foreach ($legend as $l) {
                $eventExists = false;
                $eventDayCount = 0;

                foreach ($worker->workerEvents as $event) {
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

    // ///////////////////////////////////////////////////////////////////////////

    private function equal($event)
    {}

    private function legend($legend, $event) {
        dd($legend['name']);
        // dd($event);
        
        // array_map(array($this, 'equal'), $event);
    }

    private function event($event)
    {
        // dd($event->legend_id);
        $period = new CarbonPeriod($event->start, $event->end);
        $eventDayCount = $period->count();
        // echo $eventDayCount.'<br>';
        return [$event->legend_name => $eventDayCount];
    }
    
    private function worker($worker)  // , array 
    {
        // dd($worker['workerEvents']);
        $events = array_map(array($this, 'event'), $worker['workerEvents']->toArray());
        // dd($events);
        return $events;
        // dd($legend['id']);
        //if ($legend['id'] == $event->legend_id) {
            //$period = new CarbonPeriod($event->start, $event->end);
            //$eventDayCount = $period->count();
            //echo $eventDayCount;
        //}
    }
    
    public function addLegendToWorker1(Collection $legend, Collection $workers)
    {
        $events = array_map(array($this, 'worker'), $workers->toArray());
        array_map(array($this, 'legend'), $legend->toArray(), $events);
        /*
        foreach ($workers as $worker) {
            $workerLegend = [];

            foreach ($legend as $l) {
                $eventExists = false;
                $eventDayCount = 0;
                // dd($worker->workerEvents->toArray());
                // dd($legend->toArray());
                // array_map(array($this, 'eventExist'), $worker->workerEvents->toArray());

                foreach ($worker->workerEvents as $event) {
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
        */

        return [];
    }
}
