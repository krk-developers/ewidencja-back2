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
                'lastname' => 'Kowalski',
                'pesel' => '99010303835',
            ]
        );
        DB::table('workers')->insert(
            [             
                'lastname' => 'Kowalski',
                'pesel' => '100000000000',
            ]
        );
        DB::table('workers')->insert(
            [             
                'lastname' => 'Englerd',
                'pesel' => '999999999999',
            ]
        );
        DB::table('workers')->insert(
            [             
                'lastname' => 'Nowak',
                'pesel' => '62040404777',
            ]
        );
        DB::table('workers')->insert(
            [             
                'lastname' => 'Tymakowski',
                'pesel' => '62040404666',
            ]
        );
    }
}
