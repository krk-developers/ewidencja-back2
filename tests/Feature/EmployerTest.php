<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployerTest extends TestCase
{
    public function testEmployerIndexPage(): void
    {
        $response = $this->get(route('employers.index'));
        
        $response->assertStatus(200);

        // $response->assertJson(['function' => 'index']);

        $response->assertJsonStructure(
            [
                'data' => 
                [
                    '*' =>
                    [
                        'id',
                        'company',
                        'firstname',
                        'email',
                        'display_name',
                    ]
                ]
            ]
        );
    }
    
    /**
     * Test if employer is displayed
     *
     * @return void
     */
    public function testEmployerShowPage(): void
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $response = $this->get(route('employers.show', $id));

        $response->assertStatus(200);

        // $response->assertJson(['function' => "show$id"]);
        
        $response->assertJsonStructure(
            [
                'data' => 
                [
                    '*' =>
                    [
                        'id',
                        'firstname',
                        'lastname',
                        'email',
                        'type_display_name',
                    ]
                ]
            ]
        );
    }
}
