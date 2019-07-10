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
                'worker_id' => '2',
                'contract_from' => '2019-03-01',
                'part_time' => 1,
            ]
        );

        DB::table('employer_worker')->insert(
            [
                'employer_id' => '4',
                'worker_id' => '3',
                'contract_from' => '2019-01-01',
                'part_time' => 1,
            ]
        );
        DB::table('employer_worker')->insert(
            [
                'employer_id' => '4',
                'worker_id' => '1',
                'contract_from' => '2019-05-01',
                'contract_to' => '2019-12-31',
                'part_time' => 1,
            ]
        );

        /*
        DB::table('employer_worker')->insert(
            [
                'employer_id' => '3',
                'worker_id' => '2',
            ]
        );
        */
    }
}
