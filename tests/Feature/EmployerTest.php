<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class EmployerTest extends TestCase
{
    /**
     * If all employers are displayed
     *
     * @return void
     */
    public function _testEmployerIndex(): void
    {
        $response = $this->get(route('api.employers.index'));
        // dd(route('api.employers.index'));
        $response->assertStatus(200);

        // $response->assertJson(['function' => 'index']);
        $response->assertJsonFragment(
            [
                'type_display_name' => 'Pracodawca'
            ]
        );

        $response->assertJsonMissingExact(
            [
                'type_display_name' => 'Pracownik'
            ]
        );

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
                        'type_display_name',
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
    public function _testShowEmployer(): void
    {
        $this->withoutExceptionHandling();

        $employerID = 1;
        $response = $this->get(route('api.employers.show', $employerID));

        $response->assertStatus(200);

        // $response->assertJson(['function' => "show$id"]);
        
        $response->assertJsonFragment(
            [
                'type_display_name' => 'Pracownik'
            ]
        );

        $response->assertJsonMissingExact(
            [
                'type_display_name' => 'Pracodawca'
            ]
        );

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
    public function _testEmployerEvent(): void
    {
        $this->withoutExceptionHandling();

        $employerID = 1;
        $workerID = 2;
        $response = $this->get(
            route(
                'api.employers.workers.event',
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

    /**
     * Is the employer created
     *
     * @return void
     */
    public function testStoreEmployer(): void
    {
        // $this->withoutExceptionHandling();

        $response = $this->json(
            'POST',
            route('api.employers.store'),
            [
                'name' => 'Henryk',
                'email' => 'test@test.pl',
                'company' => 'Henryx',
                'password' => '12345678',
                'password_confirmation' => '12345678',
            ]
        );

        // $response->assertJson(['function' => "store"]);
        // $response->assertStatus(200);

        // dd($response->content());
        // dd($response->getOriginalContent()['errors']);
        // dd($response->status());

        $response
            ->assertStatus(201)
            ->assertJson(['created' => true]);
    }

    /**
     * Whether the Employer is update
     *
     * @return void
     */
    public function testUpdateEmployer(): void
    {
        // $this->withoutExceptionHandling();

        $lastID = DB::table('employers')->max('id');
        
        $response = $this->json(
            'PUT',
            route('api.employers.update', $lastID),
            [
                'name' => 'Henryk',
                'lastname' => 'Walezy',
                // 'email' => 'test@test.pl',
                'company' => 'Henryx',
                // 'password' => '12345678',
                // 'password_confirmation' => '12345678',
            ]
        );
        
        // $response->dump();
        // dd($response);
        $response
            ->assertStatus(200)
            ->assertJson(['updated' => false]);
        
        
        $response = $this->json(
            'PUT',
            route('api.employers.update', $lastID),
            [
                'name' => 'Paweł',
                // 'email' => 'test@test.pl',
                'company' => 'Pawelo',
                // 'password' => '12345678',
                // 'password_confirmation' => '12345678',
            ]
        );
        $response->assertStatus(200)->assertJson(['updated' => true]);
    }
    
    /**
     * If the employer is deleted
     *
     * @return void
     */
    public function testDestroyEmployer(): void
    {
        $this->withoutExceptionHandling();

        $lastID = DB::table('employers')->max('id');
        
        $response = $this->json('DELETE', route('api.employers.destroy', $lastID));

        $response->assertStatus(200)->assertJson(['deleted' => true]);
    }
}
