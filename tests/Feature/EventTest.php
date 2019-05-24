<?php

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class EventTest extends TestCase
{
    /**
     * Test if all events are displayed.
     *
     * @return void
     */
    public function _testEventIndex(): void
    {
        $response = $this->get(route('api.events.index'));

        $response->assertStatus(200);
        // $response->assertJson(['function' => 'index']);
        
        $response->assertJsonStructure(
            [
                'data' => 
                [
                    '*' =>
                    [
                        'id',
                        'start',
                        'end',
                        'title',
                        'legend_name',
                        'legend_display_name',
                        'worker_id',
                        'firstname',
                        'lastname',
                        'pesel',
                        'email',
                    ]
                ]
            ]
        );
    }

    /**
     * If store page create a worker's event
     *
     * @return void
     */
    public function testEventStore(): void
    {
        // $this->withoutExceptionHandling();
        /*
        $maxWorkerID = DB::table('workers')->max('id');
        $workerRandomID = rand(1, $maxWorkerID);
        */
        $lastID = DB::table('workers')->max('id');
        // dd($lastID);
        $worker = \App\Worker::find($lastID);
        // dd($worker->employers[0]['id']);
        $employerID = $worker->employers[0]['id'];
        $maxLegendID = DB::table('legends')->max('id');
        // dd($maxLegendID);
        $legendRandomID = rand(1, $maxLegendID);
        // dd($legendRandomID);
        /*
        $event = new \App\Event(
            [
                'legend_id' => $legendRandomID,
                'worker_id' => $worker->id,
                'start' => now(),
                'end' => now(),
                'title' => now(),
            ]
        );
        */
        $response = $this->json(
            'POST',
            route('api.events.store'),
            [
                // 'worker_id' => $worker->id,
                'employer_id' => $employerID,
                'legend_id' => $legendRandomID,
                'worker_id' => $worker->id,
                'start' => date('Y-m-d'),
                'end' => date('Y-m-d'),
                'title' => now(),
            ]
        );
        // $response->dump();
        // dd($response);
        $response
            ->assertStatus(201)
            ->assertJson(['created' => true]);

        // $saved = $worker->events()->save($event);
        // dd($saved);
    }

    /**
     * Whether the event is deleted.
     *
     * @return void
     */
    public function _testEventDestroy(): void
    {
        $this->withoutExceptionHandling();

        // $id = 31;
        $lastID = DB::table('events')->max('id');
        $response = $this->json('DELETE', route('api.events.destroy', $lastID));
        
        $response
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
