<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class EmployerWorkerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('employer_worker')->insert(
            [
                'employer_id' => '1',
                'worker_id' => '1',
            ]
        );
        DB::table('employer_worker')->insert(
            [
                'employer_id' => '1',
                'worker_id' => '2',
            ]
        );

        DB::table('employer_worker')->insert(
            [
                'employer_id' => '2',
                'worker_id' => '1',
            ]
        );

        DB::table('employer_worker')->insert(
            [
                'employer_id' => '3',
                'worker_id' => '2',
            ]
        );
    }
}
