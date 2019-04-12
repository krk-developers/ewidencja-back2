<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class EmployerProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('employer_profiles')->insert(
            [             
                'company' => 'janusz soft',
            ]
        );
        DB::table('employer_profiles')->insert(
            [             
                'company' => 'krzak spółka zoo',
            ]
        );
    }
}
