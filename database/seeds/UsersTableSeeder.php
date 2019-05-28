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
        // super admin ///////////////////////////////////////////////////////
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
                'type_id' => 1,
                'userable_id' => 2,
                'userable_type' => 'App\SuperAdmin',
                'name' => 'Kamil',
                'email' => 'kamil.sztefko@krkds.com',
                'password' => bcrypt('KamilKamil'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 1,
                'userable_id' => 3,
                'userable_type' => 'App\SuperAdmin',
                'name' => 'Monika',
                'email' => 'monika.holymczuk@krkds.com',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 1,
                'userable_id' => 4,
                'userable_type' => 'App\SuperAdmin',
                'name' => 'Grzegorz',
                'email' => 'grzegorz.zygulsk@krkds.com',
                'password' => bcrypt('123123'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 1,
                'userable_id' => 5,
                'userable_type' => 'App\SuperAdmin',
                'name' => 'Mateusz',
                'email' => 'mateusz.wilk@krkds.com',
                'password' => bcrypt('87654321'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 1,
                'userable_id' => 6,
                'userable_type' => 'App\SuperAdmin',
                'name' => 'Agnieszka',
                'email' => 'agnieszka.kowalczyk@krkds.com',
                'password' => bcrypt('1234ABCD'),
                'api_token' => Str::random(60),
            ]
        );

        // admin /////////////////////////////////////////////////////////////
        DB::table('users')->insert(
            [
                'type_id' => 2,
                'userable_id' => 1,
                'userable_type' => 'App\Admin',
                'name' => 'Agnieszka',
                'email' => 'agnieszka.karasewicz@krkds.com',
                'password' => bcrypt('12345678'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 2,
                'userable_id' => 2,
                'userable_type' => 'App\Admin',
                'name' => 'Tomasz',
                'email' => 'tomasz.tomaszewski@gmail.com',
                'password' => bcrypt('1A2B3C4D'),
                'api_token' => Str::random(60),
            ]
        );
        DB::table('users')->insert(
            [
                'type_id' => 2,
                'userable_id' => 3,
                'userable_type' => 'App\Admin',
                'name' => 'Ernest',
                'email' => 'kepa@o2.pl',
                'password' => bcrypt('24680135'),
                'api_token' => Str::random(60),
            ]
        );
        
        // employer //////////////////////////////////////////////////////////
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
                'name' => 'Sebastian',
                'email' => 'seba@biz.pl',
                'password' => bcrypt('ABCDEF'),
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

        // worker ////////////////////////////////////////////////////////////
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
