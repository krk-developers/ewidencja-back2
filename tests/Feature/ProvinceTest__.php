<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProvinceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProvinceIndex(): void
    {
        // $this->withoutExceptionHandling();

        $response = $this->get(route('api.provinces.index'));
        // $response->assertJson(['function' => 'index']);
        $response->assertJsonFragment(['id' => 1, 'name' => 'dolnośląskie']);
        $response->assertJsonCount(16, 'data');
        $response->assertJsonStructure(['data' => ['*' => ['id', 'name']]]);
        $response->assertStatus(200);
    }
}
