<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class TypeTest extends TestCase
{
    /**
     * If all type of users are displayed.
     *
     * @return void
     */
    public function testUserTypeIndexPage(): void
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get(route('api.user_types.index'));

        $response->assertStatus(200);
        
        // $response->assertJson(['function' => 'index']);

        $response->assertJsonFragment(
            [
                'display_name' => 'Super Administrator',
                'display_name' => 'Administrator',
                'display_name' => 'Pracodawca',
                'display_name' => 'Pracownik',
            ]
        );
        
        $response->assertJsonCount(4, 'data');
        
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
}
