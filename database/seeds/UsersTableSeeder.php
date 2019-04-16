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
                'userable_type' => 'App\SuperAdmin',
                'name' => 'Artur',
                'email' => 'artur-milkowski@tlen.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        

        DB::table('users')->insert(
            [
                'type_id' => 2,
                'userable_id' => 1,
                'userable_type' => 'App\Admin',                
                'name' => 'Kamil',
                'email' => 'kamil.sztefko@krkds.com',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 2,
                'userable_id' => 2,
                'userable_type' => 'App\Admin',                
                'name' => 'Monika',
                'email' => 'monika.holymczuk@krkds.com',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );


        DB::table('users')->insert(
            [
                'type_id' => 3,
                'userable_id' => 1,
                'userable_type' => 'App\Employer',
                'name' => 'Janusz',
                'email' => 'janusz@biz.com',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 3,
                'userable_id' => 2,
                'userable_type' => 'App\Employer',           
                'name' => 'Grażyna',
                'email' => 'grazka@biz.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 3,
                'userable_id' => 3,
                'userable_type' => 'App\Employer',           
                'name' => 'Bill',
                'email' => 'bill.gates@microsoft.com',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 3,
                'userable_id' => 4,
                'userable_type' => 'App\Employer',           
                'name' => 'Tim',
                'email' => 'tcook@apple.com',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );


        DB::table('users')->insert(
            [
                'type_id' => 4,
                'userable_id' => 1,
                'userable_type' => 'App\Worker',
                'name' => 'Jan',
                'email' => 'janek@onet.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 4,
                'userable_id' => 2,
                'userable_type' => 'App\Worker',
                'name' => 'Jan',
                'email' => 'kowalski@onet.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 4,
                'userable_id' => 3,
                'userable_type' => 'App\Worker',
                'name' => 'Jan',
                'email' => 'englerd@wp.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 4,
                'userable_id' => 4,
                'userable_type' => 'App\Worker',
                'name' => 'Edward',
                'email' => 'nozycoreki@wp.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 4,
                'userable_id' => 5,
                'userable_type' => 'App\Worker',
                'name' => 'Stanisław',
                'email' => 'staszek@o2.pl',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
    }
}
