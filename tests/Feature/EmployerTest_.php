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
    public function testEmployerIndex(): void
    {
        $response = $this->get(route('api.employers.index'));
        // dd(route('api.employers.index'));
        $response->assertStatus(200);

        // $response->assertJson(['function' => 'index']);
        /*
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
        */
        $response->assertJsonStructure(
            [
                'data' => 
                [
                    '*' =>
                    [
                        'id',
                        'company',
                        //'firstname',
                        //'email',
                        //'type_display_name',
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
    public function testEmployerEvent(): void
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
                // 'company' => 'Henryx',
                'password' => '12345678',
                'password_confirmation' => '12345678',
                'company' => 'Henryx',
                'nip' => 12345678909,
                'street' => 'Na Wspólnej 1/2',
                'zip_code' => '00-001',
                'city' => 'Warszawa',
                'province_id' => 2,
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
                'company' => 'Henryx',
            ]
        );
        // $response->dump();
        
        $response
            ->assertStatus(200)
            ->assertJson(['updated' => false]);
        
        
        $response = $this->json(
            'PUT',
            route('api.employers.update', $lastID),
            [
                'name' => 'Paweł',
                'company' => 'Pawelo',
                'city' => 'Łódź',
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

    public function testAddWorker(): void
    {
        $employerID = 1;
        $workerID = 1;

        $data = [
            'employer_id' => $employerID,
            'worker_id' => $workerID,
            'contract_from' => '2019-05-01',
            'contract_to' => '',
            'part_time' => 0.5,
        ];

        $response = $this->json(
            'POST',
            route(
                'api.employers.workers.store',
                $employerID
            ),
            $data
        );

        // $response->dump();
        // $response->assertStatus(200);

        $response
            ->assertStatus(201)
            ->assertJson(['created' => true]);
    }

    public function testRemoveWorker(): void
    {
        $employerID = 1;
        $workerID = 1;

        $response = $this->json(
            'DELETE',
            route(
                'api.employers.workers.destroy',
                [$employerID, $workerID]
            )
        );

        $response->assertStatus(200)->assertJson(['deleted' => true]);
    }
}
