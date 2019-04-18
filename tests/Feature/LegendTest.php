<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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
        
        // route('legends.index')
        // $token = 'Al5TWJKhV7vviKEN4JFYpVX0li8SMCQLHGlkZjqKcXSlXQ2rOOP4VyNZm9fx';
        // $request = new Request();
        // $token = $request->cookie('rectok');
        // $token = \Cookie::get('rectok');
        // dd($token);
        $user = \App\User::find(1);
        $token = \App\User::apiToken($user->id);
        // dd($user);
        $response = $this->actingAs($user)->get(route('home'));
        $response->assertCookie('rectok', $token);  // , $value = null

        $response = $this->withHeaders(
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        )->get(route('legends.index'));

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

    public function _testUnauthenticatedLegendIndexPage(): void
    {
        $response = $this->get(route('legends.index'));

        $response->assertStatus(302);
    }

    /**
     * If store page create a event's legend
     *
     * @return void
     */
    public function _testLegendStorePage(): void
    {
        // $legend = factory(\App\Legend::class)->make();
        // create()        

        $this->withoutExceptionHandling();

        $response = $this->json(
            'POST',
            route('legends.store'),
            [
                'name' => 'XXX',
                'display_name' => 'Dzień filmów X',
                'description' => 'Dzień oglądania filmów dla dorosłych',
                'working_day' => 0,
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
    public function _testLegendDestroyPage(): void
    {
        $this->withoutExceptionHandling();

        // $id = 31;
        $lastID = DB::table('legends')->max('id');
        $response = $this->json('DELETE', route('legends.destroy', $lastID));
        
        $response
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
