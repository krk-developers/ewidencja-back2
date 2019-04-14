<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomePageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Ewidencja');
        $response->assertSeeText('Ewidencja');
        $response->assertViewIs('welcome');        
    }
}
