<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployerTest extends TestCase
{
    /**
     * If all employers are displayed
     *
     * @return void
     */
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
     * If employer's workers are displayed
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

    /**
     * If events of the worker who work for the employer are displayed
     *
     * @return void
     */
    public function testEmployerEventPage(): void
    {
        $this->withoutExceptionHandling();

        $employerID = 1;
        $workerID = 2;
        $response = $this->get(
            route(
                'employers.workers.event',
                [
                    $employerID, $workerID
                ]
            )
        );

        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'data' => 
                [
                    '*' =>
                    [
                        'id',
                        'start',
                        'end',
                        'title',
                        'legend_name',
                        'legend_display_name',
                    ]
                ]
            ]
        );
    }
}
