<?php

declare(strict_types = 1);

namespace Tests\Unit;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\{Worker, Employer};
use App\Record\Collective;
use Illuminate\Database\Eloquent\Collection;

class CollectiveRecordTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testBase(): void
    {
        $employer = Employer::findRow(4);
        // $this->assertNull($employer);
        $this->assertIsObject($employer);

        $collective = new Collective();
        $this->assertIsObject($collective);

        $yearMonth = '2019-05';
        $record = $collective->calculate($employer, $yearMonth);
        $this->assertIsArray($record);
        $this->assertEquals('2019-05-01', $record['start']);
        $this->assertEquals('2019-05-31', $record['end']);
        $this->assertEquals(false, $record['is_future']);
        $this->assertEquals('maj', $record['month_name']);
        $this->assertEquals(31, $record['days_in_month']);
        $this->assertEquals(21, $record['working_days']);
        // $time_period_public_holiday_filter
        $this->assertEquals(287, $record['total_worked_hours']);
        $this->assertEquals(41, $record['total_worked_days']);
        $this->assertEquals(2, $record['public_holidays_count']);
        // $public_holidays_in_month->count()
        
        $workers = $record['workers'];
        $this->assertInstanceOf(Collection::class, $workers);

        $worker1 = $workers[0];
        $this->assertInstanceOf(Worker::class, $worker1);
        $this->assertEquals(21, $worker1['workedDays']);
        $this->assertEquals(147, $worker1['workedHours']);
        $this->assertCount(0, $worker1['workerEvents']);  // worker's event (abcense)
        // $this->assertIsArray($worker1);

        $worker2 = $workers[1];
        $this->assertInstanceOf(Worker::class, $worker2);
        $this->assertEquals(20, $worker2['workedDays']);
        $this->assertEquals(140, $worker2['workedHours']);
        $this->assertCount(1, $worker2['workerEvents']);


        $yearMonth = '2019-06';
        $record = $collective->calculate($employer, $yearMonth);
        $this->assertIsArray($record);
        $this->assertEquals('2019-06-01', $record['start']);
        $this->assertEquals('2019-06-30', $record['end']);
        $this->assertEquals(false, $record['is_future']);
        $this->assertEquals('czerwiec', $record['month_name']);
        $this->assertEquals(30, $record['days_in_month'], 'days in month');
        $this->assertEquals(19, $record['working_days'], 'working days');
        $this->assertEquals(
            210, $record['total_worked_hours'], 'total worked hours'
        );
        $this->assertEquals(30, $record['total_worked_days'], 'total worked days');
        $this->assertEquals(
            2, $record['public_holidays_count'], 'public holidays count'
        );
        // $public_holidays_in_month->count()
        
        $workers = $record['workers'];
        $this->assertInstanceOf(Collection::class, $workers);

        $worker1 = $workers[0];
        $this->assertInstanceOf(Worker::class, $worker1);
        $this->assertEquals(16, $worker1['workedDays'], 'worked days');
        $this->assertEquals(112, $worker1['workedHours'], 'worked hours');
        $this->assertCount(2, $worker1['workerEvents'], 'worker events');  // worker's event (abcense)
        // $this->assertIsArray($worker1);

        $worker2 = $workers[1];
        $this->assertInstanceOf(Worker::class, $worker2);
        $this->assertEquals(14, $worker2['workedDays'], 'worked days');
        $this->assertEquals(98, $worker2['workedHours'], 'worked hours');
        $this->assertCount(1, $worker2['workerEvents'], 'worker events');
    }
}
