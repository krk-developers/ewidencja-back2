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
        $response = $this->get('/api/events');

        $response->assertStatus(200);
        // $response->assertJson(['function' => 'index']);
        $response->assertJsonStructure(
            [
                'data' => 
                [
                    '*' =>
                    [
                        'legend_id',
                        'user_id',
                        'start',
                        'end',
                        'title'
                    ]
                ]
            ]
        );
    }
}
