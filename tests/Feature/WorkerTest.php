<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testWorkerIndexPage(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('workers.index'));
        // dd($response);
        $response->assertStatus(200);

        // $response->assertJson(['function' => 'index']);
        
        $response->assertJsonMissingExact(
            [
                'type_display_name' => 'Super Administrator',
                'type_display_name' => 'Administrator',
                'type_display_name' => 'Pracodawca'
            ]
        );

        $response->assertJsonStructure(
            [
                'data' => 
                [
                    '*' =>
                    [
                        'id',
                        'firstname',
                        'lastname',
                        'email',
                        'type_display_name',
                    ]
                ]
            ]
        );        
    }

    /**
     * Test if employer's events are displayed
     *
     * @return void
     */
    public function testWorkerShowPage(): void
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $response = $this->get(route('workers.show', $id));

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
        // $response->assertJson(['function' => "show$id"]);

        // $response->assertJsonCount(1);
    }
}
