<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class SuperAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('super_admins')->insert(
            [             
                'lastname' => 'miłkowski',
            ]
        );
    }
}