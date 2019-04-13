<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /*
        // Dni ustawowo wolne od pracy w 2019 roku
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-01-01',                
                'title' => 'Nowy Rok, Świętej Bożej Rodzicielki',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-01-06',
                'title' => 'Trzech Króli (Objawienie Pańskie)',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-04-21',
                'title' => 'Wielkanoc',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-04-22',
                'title' => 'Poniedziałek Wielkanocny',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-05-01',
                'title' => 'Święto Pracy',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-05-03',
                'title' => 'Święto Konstytucji 3 Maja',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-06-09',
                'title' => 'Zesłanie Ducha Świętego (Zielone Świątki)',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-06-20',
                'title' => 'Boże Ciało',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-08-15',
                'title' => 'Święto Wojska Polskiego, Wniebowzięcie Najświętszej Maryi Panny',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-11-01',
                'title' => 'Wszystkich Świętych',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-11-11',
                'title' => 'Święto Niepodległości',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-12-25',
                'title' => 'Boże Narodzenie (pierwszy dzień)',
            ]
        );
        DB::table('events')->insert(
            [
                // 'all_day' => 1,
                'start' => '2019-12-26',
                'title' => 'Boże Narodzenie (drugi dzień)',
            ]
        );
        */
        // ///////////////////////////////////////////////////////////////////

        DB::table('events')->insert(
            [
                // 'all_day' => 0,
                'legend_id' => 1,
                'user_id' => 1,
                'start' => '2019-04-13',
                'end' => '2019-04-13',
                'title' => 'Uważać na czarne koty',
            ]
        );
        DB::table('events')->insert(
            [
                'legend_id' => 1,
                'user_id' => 1,
                // 'all_day' => 0,
                'start' => '2019-04-14',
                'end' => '2019-04-14',
                'title' => 'Wykorzystać handlową niedzielę',
            ]
        );
        
        DB::table('events')->insert(
            [
                'legend_id' => 2,
                'user_id' => 2,
                'start' => '2019-04-15',
                'end' => '2019-04-17',
                'title' => 'Zacząć kurs Node.js',
            ]
        );
        DB::table('events')->insert(
            [
                'legend_id' => 2,
                'user_id' => 2,
                'start' => '2019-04-18',
                'end' => '2019-04-18',
                'title' => 'Nakarmić wreszcie burka',
            ]
        );

        DB::table('events')->insert(
            [
                'legend_id' => 2,
                'user_id' => 4,
                'start' => '2019-04-19',
                'end' => '2019-04-19',
                'title' => 'Zatrudnić nowych pracowników',
            ]
        );
        DB::table('events')->insert(
            [
                'legend_id' => 2,
                'user_id' => 4,
                'start' => '2019-04-20',
                'end' => '2019-04-21',
                'title' => 'Zwolnić starych pracowników (chcą podyżek)',
            ]
        );
        DB::table('events')->insert(
            [
                'legend_id' => 2,
                'user_id' => 4,
                'start' => '2019-04-23',
                'end' => '2019-04-23',
                'title' => 'Przeprowadzić szkolenie BHP z pracownikami',
            ]
        );

        DB::table('events')->insert(
            [
                'legend_id' => 3,
                'user_id' => 6,
                'start' => '2019-04-24',
                'end' => '2019-04-24',
                'title' => 'Chycić się wreszcie porządnie za robote',
            ]
        );
        DB::table('events')->insert(
            [
                'legend_id' => 3,
                'user_id' => 6,
                'start' => '2019-04-25',
                'end' => '2019-04-25',
                'title' => 'Nie pić w pracy, a przynajmniej nie dzisiaj',
            ]
        );
        DB::table('events')->insert(
            [
                'legend_id' => 3,
                'user_id' => 6,
                'start' => '2019-04-25',
                'end' => '2019-04-25',
                'title' => 'Iść z prośbą o podwyżkę',
            ]
        );
    }
}
