<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * Test if all users are displeyed.
     *
     * @return void
     */
    public function testUserIndexPage(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/api/users');

        $response->assertStatus(200);
        // $response->assertJson(['function' => 'index']);
        /*
        $response->assertJsonFragment(
            [
                'name' => 'artur'
            ]
        );
        */
    }
}
