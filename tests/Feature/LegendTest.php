<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class LegendTest extends TestCase
{
    /**
     * If all event's legends displayed
     *
     * @return void
     */
    public function testLegendIndexPage(): void
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get(route('legends.index'));
        
        $response->assertStatus(200);
        
        $response->assertJsonFragment(
            [
                'display_name' => "Święto / choroba"
            ],
            [
                'display_name' => "Urlop Wypoczynkowy"
            ]
        );
        
        $response->assertJsonStructure(
            [
                'data' => 
                [
                    '*' =>
                    [
                        'id',
                        'name',
                        'display_name',
                        'description',
                        'working_day'
                    ]
                ]
            ]
        );
    }    
}
