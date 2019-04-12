<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class LegendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('legends')->insert(
            [
                'name' => 'DP',
                'display_name' => 'Dzień przepracowany',
                'description' => '',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'UW',
                'display_name' => 'Urlop wypoczynkowy',
                'description' => '',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'Ś',
                'display_name' => 'Święto, niedziela, dzień wolny ustawowo',
                'description' => '',
            ]
        );
    }
}
