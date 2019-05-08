<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomePageTest extends TestCase
{
    /**
     * Welcome page test.
     *
     * @return void
     */
    public function testBasicTest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        // $response->assertSee('Ewipanel');
        // $response->assertSeeText('Ewipanel');
        // $response->assertViewIs('welcome');        
    }
}
