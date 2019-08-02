<?php

declare(strict_types = 1);

namespace Tests\Unit;

use Tests\TestCase;
use App\{Worker, Employer};
use App\Record\Individual;

class IndividualRecordTest extends TestCase
{
    /**
     * Records test.
     *
     * @return void
     */
    public function testBase(): void
    {
        $worker = Worker::findRow(3);
        $this->assertIsObject($worker);

        $employer = Employer::findRow(4);
        $this->assertIsObject($employer);

        $individual = new Individual();
        $this->assertIsObject($individual);

        $yearMonth = '2019-06';
        $record = $individual->calculate($worker, $employer, $yearMonth);
        $this->assertIsArray($record);
        $this->assertArrayHasKey('worker', $record);
        $this->assertEquals($record['days_in_month'], 30);
        $this->assertEquals($record['working_days'], 19);  // Dni pracujących
        $this->assertEquals($record['public_holidays_in_month_count'], 2);
        $this->assertEquals($record['absence_in_days'], 5);
        $this->assertEquals($record['worker_worked_days'], 14);
        $this->assertEquals($record['worker_worked_hours'], 98);
        
        $yearMonth = '2019-05';
        $record = $individual->calculate($worker, $employer, $yearMonth);
        $this->assertArrayHasKey('worker', $record);
        $this->assertEquals($record['days_in_month'], 31);
        $this->assertEquals($record['working_days'], 21);  // Dni pracujących
        $this->assertEquals($record['public_holidays_in_month_count'], 2);
        $this->assertEquals($record['absence_in_days'], 1);
        $this->assertEquals($record['worker_worked_days'], 20);
        $this->assertEquals($record['worker_worked_hours'], 140);
    }
}
