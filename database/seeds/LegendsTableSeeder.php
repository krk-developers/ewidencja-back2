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
        // Typy nieobecności
        DB::table('legends')->insert(
            [
                'name' => 'CHZ100',
                'display_name' => 'Choroba zgłoszona 100%',
                'description' => 'Choroba u kobiety ciężarnej, płatna 100%',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'Ś/CH',
                'display_name' => 'Święto / choroba',
                'description' => 'Nanosi się na sobotę i niedzielę, bo choroba jest w kadrach liczona łącznie ze świętami',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'UW',
                'display_name' => 'Urlop Wypoczynkowy',
                'description' => 'Nanosi się tylko na dni robocze',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'SZ',
                'display_name' => 'Szpital',
                'description' => '',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'Ś/CHZ',
                'display_name' => 'Święto / choroba zgłoszona',
                'description' => 'Choroba zgłoszona oznacza chorobę, którą zgłosił pracownik, ale nie ma na to jeszcze dokumentu',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'DUW',
                'display_name' => 'Dodatkowy urlop wypoczynkowy',
                'description' => '',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'TR',
                'display_name' => 'Turnus rehabilitacyjny',
                'description' => '',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'Ś/SZ',
                'display_name' => 'Święto / szpital',
                'description' => 'Tak samo jak z chorobą (w?) święta',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'UB',
                'display_name' => 'Urlop bezpłatny',
                'description' => 'Urlop bezpłatny również liczy się w ciągu łącznie ze świętami',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'UO',
                'display_name' => 'Urlop okolicznościowy tylko na dni robocze',
                'description' => 'Dotyczy śmierci, ślubu lub urodzin dziecka',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'Ś/UM',
                'display_name' => 'Święto / urlop macierzyński',
                'description' => 'Nanosi się również ciągiem, łącznie ze świętami',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'UM',
                'display_name' => 'Urlop macierzyński',
                'description' => '',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'DOD',
                'display_name' => 'Dzień opieki nad dzieckiem',
                'description' => 'Dotyczy tylko dni roboczych. Maksymalnie dwa dni w roku',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'Ś/CH100',
                'display_name' => 'Święto / choroba udokumentowana 100%',
                'description' => 'Choroba udokumentowania, czyli zwolnienie dotarło do pracodawcy. Choroba płatna 100% tylko w przypadku kobiet ciężarnych',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'NP',
                'display_name' => 'Nieobecność płatna',
                'description' => 'Dzień dla osoby z niepełnosprawnością na wizytę u specjalisty związanego z jego schorzeniem lub dzień serwisowy',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'NN',
                'display_name' => 'Nieobecność nieusprawiedliwiona, niepłatna (niesądowa)',
                'description' => '',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'Ś/CHZ100',
                'display_name' => 'Święto / choroba zgłoszona 100%',
                'description' => '',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'CH',
                'display_name' => 'Choroba udokumentowana',
                'description' => 'Zwykłe zwolnienie',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'NUN',
                'display_name' => 'Nieobecność usprawiedliwiona niepłatna',
                'description' => 'Na przykład sąd. (Należy dostarczyć wezwanie do sądu)',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'DZUW',
                'display_name' => 'Dzień ustawowo wolny',
                'description' => '',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'CHZ',
                'display_name' => 'Choroba zgłoszona',
                'description' => '',
            ]
        );
        DB::table('legends')->insert(
            [
                'name' => 'X',
                'display_name' => 'Brak zatrudnienia',
                'description' => 'Pracownik zaczyna pracę od określonej daty w przyszłości, ale do tej daty ma X w ewidencji',
            ]
        );
    }
}
