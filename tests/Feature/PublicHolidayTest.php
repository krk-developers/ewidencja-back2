<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicHolidayTest extends TestCase
{
    /**
     * If all public holidays are displayed.
     *
     * @return void
     */
    public function testPublicHolidayIndexPage(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('api.public_holidays.index'));

        $response->assertStatus(200);

        // $response->assertJson(['function' => 'index']);

        $response->assertJsonFragment(
            [
                'legend_name' => 'DZUW',
                'legend_diplay_name' => 'Dzień ustawowo wolny',
            ]
        );

        $response->assertJsonCount(13, 'data');

        $response->assertJsonStructure(
            [
                'data' => 
                [
                    '*' =>
                    [
                        'id',
                        'start',
                        'title',
                        'legend_name',
                        'legend_diplay_name',
                        'legend_description',
                    ]
                ]
            ]
        );
    }

    /**
     * If nerest public holiday is displayed.
     *
     * @return void
     */
    public function testNerestPublicHolidayIndexPage(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('api.nearest_public_holidays.index'));

        $response->assertStatus(200);

        // $response->assertJson(['function' => 'index']);

        $response->assertJsonCount(1);
        
        $response->assertJsonFragment(
            [
                'legend_name' => 'DZUW',
                'legend_diplay_name' => 'Dzień ustawowo wolny',
            ]
        );
        
        $response->assertJsonStructure(
            [
                'data' => 
                [
                    'id',
                    'start',
                    'title',
                    'legend_name',
                    'legend_diplay_name',
                    'legend_description',
                ]
            ]
        );
    }
}
