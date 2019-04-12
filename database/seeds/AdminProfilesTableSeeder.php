<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class AdminProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('admin_profiles')->insert(
            [             
                'lastname' => 'sztefko',
            ]
        );
        DB::table('admin_profiles')->insert(
            [             
                'lastname' => 'hołymczuk',
            ]
        );
    }
}
