@extends('layouts.print')

@section('title', 'Ewidencja zbiorcza ' . $month_name)

@section('content')
        <table class="header">
            <tbody>
                <tr>
                    <td>Pracodawca: {{ $employer->company }}</td>
                    <td>Okres: {{ $year_month }}</td>
                </tr>
            </tbody>
        </table>

        <table class="main">
            <tbody>
                <tr>
                    <td>Liczba dni w miesiącu: {{ $days_in_month }}</td>
                    <td>Liczba dni pracujących: {{ $time_period_public_holiday_filter }}</td>
                    <td>Liczba dni ustawowo wolnych od pracy: {{ $public_holidays_in_month_count }}</td>
                    <td>Liczba nieobecności: {{ $absence_in_days }}</td>                    
                    <td>Liczba dni przepracowanych: {{ $working_days }}</td>
                </tr>
            </tbody>
        </table>

        <table class="collective">
            <thead>
                <tr>
                    <td>Imię</td>
                    <td>Nazwisko</td>
                    <td>PESEL</td>
                    <td title="Ekwiwalent">Ekw</td>
                    <td>Kwota</td>
                    <td>Etat</td>
                    <td>Suma godz.</td>
@foreach ($legend as $legend_)
                    <td>{{ $legend_->name }}</td>
@endforeach
                </tr>
            </thead>
            <tbody>
@foreach($workers as $worker)
                <tr>
                    <td>{{ $worker->user->name }}</td>
                    <td>{{ $worker->lastname }}</td>
                    <td>{{ $worker->pesel }}</td>
                    <td>{{ $worker->equivalent }}</td>
                    <td>{{ $worker->equivalent_amount }}</td>
                    <td>{{ $worker->effective }}</td>
                    <td>{{ $worker->workingHoursDuringMonth }}</td>
@foreach ($worker->legend as $key)
                    <td>
                        {{ $key }}
                    </td>
@endforeach
                </tr>
@endforeach
                <tr>
                    <td colspan="7" class="text-right">{{ $totalWorkingHours }}</td>
                    <td colspan="22"></td>
                </tr>
            </tbody>
        </table>

        <div class="sign">Podpis doradcy zawodowego</div>
        <div class="sign">Podpis pracownika działu kadr</div>
        <div class="sign">Podpis koordynatora</div>

        <div class="legend">
            <table class="left">
                <tbody>
@foreach ($legend_groups[0] as $legend)
                    <tr>
                        <td>{{ $legend->name }}:</td>
                        <td>{{ $legend->display_name }}</td>
                    </tr>
@endforeach
                </tbody>
            </table>
        </div>

        <div class="legend">
            <table class="right">
                <tbody>
@foreach ($legend_groups[1] as $legend)
                    <tr>
                        <td>{{ $legend->name }}:</td>
                        <td>{{ $legend->display_name }}</td>
                    </tr>
@endforeach
                </tbody>
            </table>
        </div>
@endsection
