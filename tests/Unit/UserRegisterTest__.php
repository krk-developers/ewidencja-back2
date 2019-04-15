<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Generator as Faker;

class UserRegisterTest extends TestCase
{
    // use RefreshDatabase;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanRegister()
    {

        // first, user 'profile'
        $employer = factory(\App\Employer::class)->create();
        // $this->assertIsString($employer);  // 'App\Employer'
        $this->assertEquals($employer, "App\Employer");
        // echo ($employer);
        /*
        $type_id = \App\Type::findIDByModelName($employer);
        $this->assertIsNumeric($type_id);
        $this->assertContains($type_id, [3, 4]);
        $userable_id = $employer->id;  // created 'profile'
        $this->assertIsNumeric($userable_id);
        
        $user = User::create(
            [
                'type_id' => $type_id,  // user's type
                'userable_id' => $userable_id,  // user's profile id
                'userable_type' => $employer,  // user's profile type
                'name' => 'Jan',
                'email' => 'jan@onet.pl',
                'password' => Hash::make('password'),
                'api_token' => Str::random(60),
            ]
        );
        */
        //userable_type

        // echo PHP_EOL;
        // dd($employer);
        // $userTypesCanRegister = \App\Type::Registrable();
        // dd($userTypesCanRegister->pluck('model')->all());
        // $this->assertTrue(true);
    }
}
