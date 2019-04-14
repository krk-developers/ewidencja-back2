<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class WorkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('workers')->insert(
            [             
                'lastname' => 'kowalski',
            ]
        );
        DB::table('workers')->insert(
            [             
                'lastname' => 'kowalski',
            ]
        );
        DB::table('workers')->insert(
            [             
                'lastname' => 'nowak',
            ]
        );
    }
}
