<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('provinces')->insert(['name' => 'dolnośląskie']);
        DB::table('provinces')->insert(['name' => 'kujawsko-pomorskie']);
        DB::table('provinces')->insert(['name' => 'lubelskie']);
        DB::table('provinces')->insert(['name' => 'lubuskie']);
        DB::table('provinces')->insert(['name' => 'łódzkie']);
        DB::table('provinces')->insert(['name' => 'małopolskie']);
        DB::table('provinces')->insert(['name' => 'mazowieckie']);
        DB::table('provinces')->insert(['name' => 'opolskie']);
        DB::table('provinces')->insert(['name' => 'podkarpackie']);
        DB::table('provinces')->insert(['name' => 'podlaskie']);
        DB::table('provinces')->insert(['name' => 'pomorskie']);
        DB::table('provinces')->insert(['name' => 'śląskie']);
        DB::table('provinces')->insert(['name' => 'świętokrzyskie']);
        DB::table('provinces')->insert(['name' => 'warmińsko-mazurskie']);
        DB::table('provinces')->insert(['name' => 'wielkopolskie']);
        DB::table('provinces')->insert(['name' => 'zachodniopomorskie']);
    }
}
