<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class EmployersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('employers')->insert(['company' => 'Janusz Soft']);
        DB::table('employers')->insert(['company' => 'Sebix']);
        DB::table('employers')->insert(['company' => 'Microsoft Corporation']);
        DB::table('employers')->insert(['company' => 'Apple Inc.']);
    }
}
