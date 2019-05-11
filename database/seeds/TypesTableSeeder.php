<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('types')->insert(
            [
                'registrable' => 0,
                'model' => 'App\SuperAdmin',
                'name' => 'superadmin',
                'display_name' => 'Super Administrator',
                'description' => 'Wszystkie uprawnienia',
            ]
        );
        DB::table('types')->insert(
            [
                'registrable' => 0,
                'model' => 'App\Admin',
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Dodawanie administratorów, dodawanie i edycja pracodawców, pracowników i wydarzeń',
            ]
        );
        DB::table('types')->insert(
            [
                'registrable' => 1,
                'model' => 'App\Employer',
                'name' => 'employer',
                'display_name' => 'Pracodawca',
                'description' => 'Zatrudnia pracowników',
            ]
        );
        DB::table('types')->insert(
            [
                'registrable' => 1,
                'model' => 'App\Worker',
                'name' => 'worker',
                'display_name' => 'Pracownik',
                'description' => 'Osoba wykonująca pracę na rzecz pracodawcy',
            ]
        );
    }
}
