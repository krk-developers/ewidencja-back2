<?php

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    /**
     * Test if all events are displayed.
     *
     * @return void
     */
    public function testEventIndexPage(): void
    {
        $response = $this->get(route('events.index'));

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
}
