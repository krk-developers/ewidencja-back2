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
        DB::table('employers')->insert(
            [             
                'company' => 'janusz soft',
            ]
        );
        DB::table('employers')->insert(
            [             
                'company' => 'krzak spółka zoo',
            ]
        );
    }
}
