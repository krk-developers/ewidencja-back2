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
        DB::table('provinces')->insert(['province' => 'dolnośląskie']);
        DB::table('provinces')->insert(['province' => 'kujawsko-pomorskie']);
        DB::table('provinces')->insert(['province' => 'lubelskie']);
        DB::table('provinces')->insert(['province' => 'lubuskie']);
        DB::table('provinces')->insert(['province' => 'łódzkie']);
        DB::table('provinces')->insert(['province' => 'małopolskie']);
        DB::table('provinces')->insert(['province' => 'mazowieckie']);
        DB::table('provinces')->insert(['province' => 'opolskie']);
        DB::table('provinces')->insert(['province' => 'podkarpackie']);
        DB::table('provinces')->insert(['province' => 'podlaskie']);
        DB::table('provinces')->insert(['province' => 'pomorskie']);
        DB::table('provinces')->insert(['province' => 'śląskie']);
        DB::table('provinces')->insert(['province' => 'świętokrzyskie']);
        DB::table('provinces')->insert(['province' => 'warmińsko-mazurskie']);
        DB::table('provinces')->insert(['province' => 'wielkopolskie']);
        DB::table('provinces')->insert(['province' => 'zachodniopomorskie']);
    }
}
