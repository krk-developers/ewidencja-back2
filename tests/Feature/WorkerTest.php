<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\ValidationException;
use App\{User, Worker};
use Illuminate\Support\Facades\DB;

class WorkerTest extends TestCase
{
    /**
     * If all workers are displayed.
     *
     * @return void
     */
    public function testWorkerIndex(): void
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
    public function testWorkerShow(): void
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
    public function testCreateWorker(): void
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
                'contract_from' => '2019-05-19',
                'part_time' => 0.75,
                'equivalent' => 1,  // The equivalent amount field is required
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
                'contract_from' => '2019-05-19',
                'part_time' => 0.75,
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
    public function testUpdateWorker(): void
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
                'contract_from' => '2019-05-19',
                'contract_to' => null,
                'part_time' => 0.50,
                'equivalent' => 1,  // equivalent_amount required
                // 'equivalent_amount' => 0,
                'effective' => 3,
            ]
        );
        // $response->dump();
        
        $response->assertStatus(422);


        $response = $this->json(
            'PUT',
            route('api.workers.update', $lastID),
            [
                'name' => 'Zofia',
                'lastname' =>  'Odyniec',
                'pesel' => 86486123569,
                'contract_from' => '2019-05-19',
                'contract_to' => '2019-05-20',
                'part_time' => 0.50,
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
    public function testDestroyWorker(): void
    {
        $this->withoutExceptionHandling();

        $lastID = DB::table('workers')->max('id');

        $response = $this->json('DELETE', route('api.workers.destroy', $lastID));
        
        $response
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
