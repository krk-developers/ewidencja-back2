<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('admins')->insert(['lastname' => 'Karasewicz']);
        DB::table('admins')->insert(['lastname' => 'Tomaszewski']);
        DB::table('admins')->insert(['lastname' => 'Kępicki']);
    }
}
