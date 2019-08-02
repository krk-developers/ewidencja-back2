<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
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
        // $this->withoutExceptionHandling();
        /*
        $user = \App\User::find(1);        
        $token = $user['api_token'];
        
        $response = $this->actingAs($user)->get(route('home'));
        
        $response->assertCookie('rectok', $token);
        */
        $response = $this->get(route('api.legends.index'));
        /*
        $response = $this->withHeaders(
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        )->get(route('api.legends.index'));
        */
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
                    ]
                ]
            ]
        );
    }

    public function _testUnauthenticatedLegendIndexPage(): void
    {
        $response = $this->get(route('api.legends.index'));

        $response->assertStatus(302);
    }

    /**
     * If store page create a event's legend
     *
     * @return void
     */
    public function testLegendStorePage(): void
    {
        // $legend = factory(\App\Legend::class)->make();
        // $this->withoutExceptionHandling();
        $user = \App\User::find(1);
        $token = $user['api_token'];
        // dd($token);
        $response = $this->withHeaders(
            ['Authorization' => 'Bearer ' . $token]
        )->json(
            'POST',
            route('api.legends.store'),
            [
                'name' => 'XXX',
                'display_name' => 'Dzień filmów X',
                'description' => 'Dzień oglądania filmów dla dorosłych',
            ]
        );
        
        $response
            ->assertStatus(201)
            ->assertJson(['created' => true]);
    }

    /**
     * If destroy page delete event's legend
     *
     * @return void
     */
    public function testLegendDestroyPage(): void
    {
        // $this->withoutExceptionHandling();
        $user = \App\User::find(1);
        $token = $user['api_token'];
        $lastID = DB::table('legends')->max('id');
        $response = $this->withHeaders(
            ['Authorization' => 'Bearer ' . $token]
        )->json('DELETE', route('api.legends.destroy', $lastID));
        
        $response
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
