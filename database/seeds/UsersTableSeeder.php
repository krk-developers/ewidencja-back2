<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'type_id' => 1,
                'userable_id' => 1,
                'userable_type' => 'App\SuperAdminProfile',
                'name' => 'artur',
                'email' => 'artur-milkowski@tlen.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        
        DB::table('users')->insert(
            [
                'type_id' => 2,
                'userable_id' => 1,
                'userable_type' => 'App\AdminProfile',                
                'name' => 'kamil',
                'email' => 'kamil.sztefko@krkds.com',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 2,
                'userable_id' => 2,
                'userable_type' => 'App\AdminProfile',                
                'name' => 'monika',
                'email' => 'monika.holymczuk@krkds.com',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );

        DB::table('users')->insert(
            [
                'type_id' => 3,
                'userable_id' => 1,
                'userable_type' => 'App\EmployerProfile',
                'name' => 'janusz',
                'email' => 'janusz@biz.com',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 3,
                'userable_id' => 1,
                'userable_type' => 'App\EmployerProfile',           
                'name' => 'grażyna',
                'email' => 'grazka@biz.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );

        DB::table('users')->insert(
            [
                'type_id' => 4,
                'name' => 'jan',
                'email' => 'janek@onet.pl',
                'userable_id' => 1,
                'userable_type' => 'App\WorkerProfile',         
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 4,
                'userable_id' => 2,
                'userable_type' => 'App\WorkerProfile',
                'name' => 'jan',
                'email' => 'kowalski@onet.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 4,
                'userable_id' => 3,
                'userable_type' => 'App\WorkerProfile',
                'name' => 'edward',
                'email' => 'nozycoreki@wp.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
    }
}
