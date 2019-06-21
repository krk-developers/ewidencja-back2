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
                    <td>Liczba dni ustawowo wolnych od pracy: {{ $public_holidays_in_month->count() }}</td>
                    <td>Liczba nieobecności: {{ $absence_in_days }}</td>                    
                    <td>Liczba dni przepracowanych: {{ $working_days }}</td>
                </tr>
            </tbody>
        </table>

        <table class="main">
            <tbody>
@foreach($workers as $worker)
                <tr>
                    <td>{{ $worker->user->name }}</td>
                    <td>{{ $worker->lastname }}</td>
                    <td>{{ $worker->pesel }}</td>
                    <td>{{ $worker->equivalent }}</td>
                    <td>{{ $worker->equivalent_amount }}</td>
                    <td>{{ $worker->effective }}</td>
                    <td><pre>{{ print_r($worker->workerEvents) }}</pre></td>
                </tr>
@endforeach
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
