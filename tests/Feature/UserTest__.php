<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * If all users are displeyed.
     *
     * @return void
     */
    public function testUserIndexPage(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('api.users.index'));

        $response->assertStatus(200);
        // $response->assertJson(['function' => 'index']);        
        /*
        $response->assertJsonFragment(
            [
                'type_display_name' => 'Super Administrator'
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
                        'firstname',
                        'type_display_name',
                        'description',
                    ]
                ]
            ]
        );
    }
}
