<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class TypeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserTypeIndexPage(): void
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/api/user_types');

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
