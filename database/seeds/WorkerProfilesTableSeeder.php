<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class WorkerProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('worker_profiles')->insert(
            [             
                'lastname' => 'kowalski',
            ]
        );
        DB::table('worker_profiles')->insert(
            [             
                'lastname' => 'kowalski',
            ]
        );
        DB::table('worker_profiles')->insert(
            [             
                'lastname' => 'nowak',
            ]
        );
    }
}
