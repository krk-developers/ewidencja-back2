<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkerTest extends TestCase
{
    /**
     * If all workers are displayed.
     *
     * @return void
     */
    public function testWorkerIndexPage(): void
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
    public function testWorkerShowPage(): void
    {
        $this->withoutExceptionHandling();
        
        // $response->assertJson(['function' => "show$id"]);

        $id = 1;
        $response = $this->get(route('api.workers.show', $id));

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
}
