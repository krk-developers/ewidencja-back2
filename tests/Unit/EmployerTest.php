<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\{Type, Employer, User};

class EmployerTest extends TestCase
{
    /**
     * Whether the employer was created.
     *
     * @return void
     */
    public function testCreateEmployer(): void
    {
        $data = [
            'company' => 'CompAny',
            // 'nip' => '1234567890',
        ];

        $typeModelName = 'App\Employer';

        $employer = Employer::createRow($data);
        
        $this->assertInstanceOf(Employer::class, $employer);
        
        $typeID = Type::findIDByModelName($typeModelName);
        
        $userableID = $employer->id;

        $userData = [
            'type_id' => $typeID,
            'userable_id' => $userableID,
            'userable_type' => $typeModelName,
            'name' => 'Testowy',
            'email' => 'email@pl',
            'password' => Hash::make('12345678'),
            'api_token' => Str::random(60),
        ];
        
        $user = User::createRow($userData);
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * Whether the employer was updated.
     *
     * @return void
     */
    public function testUpdateEmployer(): void
    {
        $lastID = DB::table('employers')->max('id');
        $employer = Employer::findRow($lastID);
        
        $employer->company = 'Firm';
        $employer->street = 'Marszałkowska 2';
        $updated = $employer->saveRow();
        
        $this->assertTrue($updated);
    }

    /**
     * Whether the employer was deleted.
     *
     * @return void
     */
    public function testDeleteEmployer(): void
    {
        $lastID = DB::table('employers')->max('id');
        $employer = Employer::findRow($lastID);
        
        $deleted = $employer->deleteRow();
        
        $this->assertTrue($deleted);
    }
}
