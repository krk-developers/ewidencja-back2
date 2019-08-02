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
     * Collective records test.
     *
     * @return void
     */
    public function testBase(): void
    {
        $employer = Employer::findRow(4);
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
        $this->assertEquals(287, $record['total_worked_hours']);
        $this->assertEquals(41, $record['total_worked_days']);
        $this->assertEquals(2, $record['public_holidays_count']);
        
        $workers = $record['workers'];
        $this->assertInstanceOf(Collection::class, $workers);

        $worker1 = $workers[0];
        $this->assertInstanceOf(Worker::class, $worker1);
        $this->assertEquals(21, $worker1['worked_days']);
        $this->assertEquals(147, $worker1['worked_hours']);
        $this->assertCount(0, $worker1['worker_events']);  // abcense
        
        $worker2 = $workers[1];
        $this->assertInstanceOf(Worker::class, $worker2);
        $this->assertEquals(20, $worker2['worked_days']);
        $this->assertEquals(140, $worker2['worked_hours']);
        $this->assertCount(1, $worker2['worker_events']);

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
        
        $workers = $record['workers'];
        $this->assertInstanceOf(Collection::class, $workers);

        $worker1 = $workers[0];
        $this->assertInstanceOf(Worker::class, $worker1);
        $this->assertEquals(16, $worker1['worked_days'], 'worked days');
        $this->assertEquals(112, $worker1['worked_hours'], 'worked hours');
        $this->assertCount(2, $worker1['worker_events'], 'worker events');  // abcense

        $worker2 = $workers[1];
        $this->assertInstanceOf(Worker::class, $worker2);
        $this->assertEquals(14, $worker2['worked_days'], 'worked days');
        $this->assertEquals(98, $worker2['worked_hours'], 'worked hours');
        $this->assertCount(1, $worker2['worker_events'], 'worker events');
    }
}
