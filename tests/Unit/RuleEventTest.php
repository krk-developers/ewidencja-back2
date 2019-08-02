<?php

declare(strict_types = 1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Rules\LegendHelper;
use App\{Worker, Employer, Days};

class RuleEventTest extends TestCase
{
    /**
     * Whether the user filled out the fields start and end.
     *
     * @return void
     */
    public function _testRequestIsNotNull(): void
    {
        $start = null;
        $end = null;
        $requestIsNotNull = LegendHelper::requestIsNotNull($start, $end);
        $this->assertFalse($requestIsNotNull);


        $start = '15-05-2019';
        $end = null;
        $requestIsNotNull = LegendHelper::requestIsNotNull($start, $end);
        $this->assertFalse($requestIsNotNull);


        $start = null;
        $end = '15-05-2019';
        $requestIsNotNull = LegendHelper::requestIsNotNull($start, $end);
        $this->assertFalse($requestIsNotNull);


        $start = '15-05-2019';
        $end = '15-05-2019';
        $requestIsNotNull = LegendHelper::requestIsNotNull($start, $end);
        $this->assertNull($requestIsNotNull);
    }

    /**
     * Whether the right name of legend was found
     *
     * @return void
     */
    public function testFindLegend(): void
    {
        $legendID = 3;  // UW
        $legend = LegendHelper::findLegend($legendID);
        $legendName = $legend->name;
        $this->assertEquals('UW', $legendName);
    }

    public function testTimePeriodChildcareDay(): void
    {
        $start = '2019-05-22';  // 2 days taken
        $end = '2019-05-23';
        $takenDaysNumber = Days::timePeriodCount($start, $end);
        $this->assertTrue($takenDaysNumber <= config('record.childcare_day'));

        $start1 = '2019-05-22';  // 3 days taken
        $end1 = '2019-05-24';
        $takenDaysNumber1 = Days::timePeriodCount($start1, $end1);
        $this->assertFalse($takenDaysNumber1 <= config('record.childcare_day'));
    }

    public function testChildcareDay(): void
    {
        $workerID = $employerID = 3;
        $worker = Worker::findRow($workerID);
        // $employer = Employer::findRow($employerID);
        
        $childcareDays = LegendHelper::childcareDaysNumber($worker, '2019-05-22');
        $this->assertTrue($childcareDays);
        /*
        $legendModel = new LegendModel();
        $legend = $legendModel->ofName('DOD')->first();
        $legendID = $legend->id;
        
        $eventStart = '2019-05-01';
        $eventEnd = '2019-05-01';
        $eventData = [
            'legend_id' => $legendID,
            'employer_id' => $employer->id,
            'worker_id' => $worker->id,
            'start' => $eventStart,
            'end' => $eventEnd,
            'title' => 'Test DOD 1',
        ];
        Event::createRow($eventData);
        
        $childcareDays1 = LegendHelper::childcareDaysNumber($worker, '2019-05-22');
        $this->assertTrue($childcareDays1);

        
        $eventStart = '2019-05-02';
        $eventEnd = '2019-05-02';
        $eventData = [
            'legend_id' => $legendID,
            'employer_id' => $employer->id,
            'worker_id' => $worker->id,
            'start' => $eventStart,
            'end' => $eventEnd,
            'title' => 'Test DOD 2',
        ];
        Event::createRow($eventData);

        $childcareDays2 = LegendHelper::childcareDaysNumber($worker, '2019-05-22');
        $this->assertTrue($childcareDays2);
        
                
        $eventStart = '2019-05-06';
        $eventEnd = '2019-05-06';
        $eventData = [
            'legend_id' => $legendID,
            'employer_id' => $employer->id,
            'worker_id' => $worker->id,
            'start' => $eventStart,
            'end' => $eventEnd,
            'title' => 'Test DOD 3',
        ];
        Event::createRow($eventData);

        $childcareDays3 = LegendHelper::childcareDaysNumber($worker, '2019-05-22');
        $this->assertFalse($childcareDays3);
        */
        
        // dd($childcareDays);
        /*
        $takenDaysNumber = 0;
        foreach ($childcareDays as $day) {
            $start = $day->start;
            $end = $day->end;
            $takenDaysNumber += Days::timePeriod($start, $end);
        }
        */
        // dd($takenDaysNumber);
        // $this->assertTrue($takenDaysNumber <= config('record.childcare_day'));
        
        /*
        $start1 = '2019-05-01';
        $end1 = '2019-05-01';
        $takenDaysNumber1 = Days::timePeriod($start1, $end1);
        // dd($takenDaysNumber1);
        $this->assertTrue($takenDaysNumber1 <= config('record.childcare_day'));
        
        $start2 = '2019-05-02';
        $end2 = '2019-05-03';
        $takenDaysNumber2 = Days::timePeriod($start2, $end2);
        $this->assertFalse($takenDaysNumber2 <= config('record.childcare_day'));
        */
    }
}
