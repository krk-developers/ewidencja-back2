<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AddEventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function _testCreateSCHEvent()
    {
        $this->withoutExceptionHandling();
        $user = User::find_(1);
        $data = [
            'worker_id' => "1",
            'employer_id' => "1",
            'title' => '',
            'start' => "2019-05-11",
            'end' => "2019-05-11",
            'legend_id' => "2"
        ];

        $response = $this->actingAs($user)
            ->post(
                route(
                    'workers.employers.events.store',
                    [1, 1, '2019-05'],
                    $data
                )
            );

        $response->assertStatus(200);
        /*
        $response->assertRedirect(
            route(
                'workers.employers.events.index',
                [1, 1, '2019-05']
            )
        );
        */
    }
}
