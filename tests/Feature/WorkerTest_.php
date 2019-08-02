<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
/*
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\ValidationException;
use App\{Employer, Worker};
*/
use Illuminate\Support\Facades\DB;

class WorkerTest extends TestCase
{
    /**
     * If all workers are displayed.
     *
     * @return void
     */
    public function _testWorkerIndex(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('api.workers.index'));

        $response->assertStatus(200);

        // $response->assertJson(['function' => 'index']);
        
        // $response->assertJsonFragment([]);
        
        /*
        $response->assertJsonMissingExact(
            [
                'type_display_name' => 'Super Administrator',
                'type_display_name' => 'Administrator',
                'type_display_name' => 'Pracodawca'
            ]
        );
        */
        
        $response->assertJsonStructure(
            [
                'data' => 
                [
                    '*' =>
                    [
                        'id',
                        'lastname',
                        'pesel',
                        'employers' => [],  // can be empty
                        'user' => 
                        [
                            'id',
                            'type_id',
                            'name',
                            'email',
                        ]
                    ]
                ]
            ]
        );
    }

    /**
     * If employer's events are displayed
     *
     * @return void
     */
    public function _testWorkerShow(): void
    {
        $this->withoutExceptionHandling();
        
        // $response->assertJson(['function' => "show$id"]);

        $workerID = 1;
        $response = $this->get(route('api.workers.show', $workerID));

        $response->assertStatus(200);
        
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
                    ]
                ]
            ]
        );
    }

    /**
     * Wheter the Worker was created
     *
     * @return void
     */
    public function _testCreateWorker(): void
    {
        // $this->withoutExceptionHandling();

        // $user = factory(User::class)->make();
        // $worker = factory(Worker::class)->make();        

        $response = $this->json(
            'POST',
            route('api.workers.store'),
            [
                'lastname' => 'Odyniec',
                'pesel' => 86486434569,
                'equivalent' => 1,
                'effective' => 3,
                'name' => 'Natalia',
                'email' => 'natka@gmail.com',
                'password' => '12345678',
                'password_confirmation' => '12345678',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // The equivalent amount field is required
        $response->assertStatus(422);


        $response = $this->json(
            'POST',
            route('api.workers.store'),
            [
                'lastname' => 'Odyniec',
                'pesel' => 86486434569,
                // 'contract_from' => '2019-05-19',
                // 'part_time' => 0.75,
                'equivalent' => 1,
                'equivalent_amount' => 20,
                'effective' => 3,
                'name' => 'Natalia',
                'email' => 'natka@gmail.com',
                'password' => '12345678',
                'password_confirmation' => '12345678',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        // $response->dump();
        
        $response
            ->assertStatus(201)
            ->assertJson(['created' => true]);
    }

    /**
     * Whether the worker is update
     *
     * @return void
     */
    public function _testUpdateWorker(): void
    {
        // $this->withoutExceptionHandling();

        $lastID = DB::table('workers')->max('id');
        // $worker = Worker::findRow($lastID);
        // dd($lastID);
        // dd($worker);

        $response = $this->json(
            'PUT',
            route('api.workers.update', $lastID),
            [
                'name' => 'Zofia',
                'lastname' =>  'Odyniec',
                'pesel' => 86486123569,
                'equivalent' => 1,
                // 'equivalent_amount' => 0,  // equivalent_amount required
                'effective' => 3,
            ]
        );
        // $response->dump();

        // equivalent_amount required
        $response->assertStatus(422);


        $response = $this->json(
            'PUT',
            route('api.workers.update', $lastID),
            [
                'name' => 'Zofia',
                'lastname' =>  'Odyniec',
                'pesel' => 86486123569,
                'equivalent' => 1,
                'equivalent_amount' => 20,
                'effective' => 1,
            ]
        );

        // $response->dump();

        $response
            ->assertStatus(200)
            ->assertJson(['updated' => true]);
    }

    /**
     * Whether the worker is deleted
     *
     * @return void
     */
    public function _testDestroyWorker(): void
    {
        $this->withoutExceptionHandling();

        $lastID = DB::table('workers')->max('id');

        $response = $this->json('DELETE', route('api.workers.destroy', $lastID));
        
        $response
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }

    public function _testAddEmployer(): void
    {
        $this->withoutExceptionHandling();

        $workerID = 1;
        $employerID = 1;
        $partTime = 1;
        $response = $this->post(
            route(
                'api.workers.employers.store',
                $workerID
            ),
            [
                'employer_id' => $employerID,
                'worker_id' => $workerID,
                'contract_from' => '2019-05-01',
                'contract_to' => '',
                'part_time' => $partTime,
            ]
        );
        // $response->assertJson(['function' => 'store']);
        // $response->dump();
        $response
            ->assertStatus(201)
            ->assertJson(['created' => true]);
    }

    public function _testRemoveEmployer(): void
    {
        // $this->withoutExceptionHandling();

        $workerID = 1;
        $employerID = 1;

        $response = $this->json(
            'DELETE',
            route(
                'api.workers.employers.destroy',
                [$workerID, $employerID]
            )
        );

        // $response->dump();

        $response->assertStatus(200)->assertJson(['deleted' => true]);
    }

    public function testEmployerEventsByDate(): void
    {
        // $this->assertTrue(true);
        $this->withoutExceptionHandling();

        $workerID = 3;
        $employerID = 4;
        $date = '2019-07';
        $response = $this->get(
            route(
                'api.workers.employers.events.date',
                [$workerID, $employerID, $date]
            )
        );

        $response->assertStatus(200);
        // $response->assertJson(['function' => 'index']);
        // dd($response);
        // $response->dumpHeaders();
        // $response->dump();
        
        $response->assertJsonStructure(
            [
                [
                    /*
                    'id',
                    'worker_id',
                    'employer_id',
                    */
                    'start',
                    'end',
                    'title',
                    /*
                    'legend_name',
                    'legend_display_name',
                    'legend_description',
                    */
                ]
            ]
        );
    }
}
