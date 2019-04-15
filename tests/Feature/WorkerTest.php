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
     * Test if employer is displayed
     *
     * @return void
     */
    public function testEmployerShowPage(): void
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $response = $this->get(route('workers.show', $id));

        $response->assertStatus(200);
        
        $response->assertJson(['function' => "show$id"]);

        $response->assertJsonCount(1);
    }
}
