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
        $this->withoutExceptionHandling();

        // $user = factory(User::class)->make();
        // $worker = factory(Worker::class)->make();        

        $response = $this->json(
            'POST',
            route('api.workers.store'),
            [
                'lastname' => 'Odyniec',
                'pesel' => '86486434569',
                'name' => 'Natalia',
                'email' => 'natka@gmail.com',
                'password' => '12345678',
                'password_confirmation' => '12345678',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        
        $response
            ->assertStatus(201)
            ->assertJson(['created' => true]);
        
    }

    public function testUpdateWorker(): void
    {
        $this->withoutExceptionHandling();

        $lastID = DB::table('workers')->max('id');
        // dd($lastID);
        $response = $this->json(
            'PUT',
            route('api.workers.update', $lastID),
            [
                'name' => 'Zofia',
                'lastname' =>  'Odyniec',
                'pesel' => '12345678909',
            ],
            [
                'id' => $lastID,
            ]
        );
        // dd($response->content());
        // dd($response->status());
        // dd($response->status());
        $response
            ->assertStatus(200)
            ->assertJson(['updated' => true]);
    }

    /**
     * Whether the worker is deleted
     *
     * @return void
     */
    public function testEventDestroyPage(): void
    {
        $this->withoutExceptionHandling();

        // $id = 31;
        $lastID = DB::table('workers')->max('id');
        // dd($lastID);
        $response = $this->json('DELETE', route('api.workers.destroy', $lastID));
        
        $response
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
