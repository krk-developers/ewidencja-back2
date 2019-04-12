<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class SuperAdminProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('super_admin_profiles')->insert(
            [             
                'lastname' => 'miłkowski',
            ]
        );
    }
}
