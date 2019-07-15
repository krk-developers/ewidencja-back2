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
                    <td>Dni w miesiącu: {{ $days_in_month }}</td>
                    <td>Dni pracujących: {{ $working_days }}</td>
                    <td>Dni ustawowo wolne od pracy: {{ $public_holidays_count }}</td>
                    <td>Suma nieobecności: {{ $total_absence_days }}</td>                    
                    <td>Suma dni przepracowanych: {{ $total_worked_days }}</td>
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
                    <td>{{ $worker->worked_hours }}</td>
@foreach ($worker->legend as $key)
                    <td>
                        {{ $key }}
                    </td>
@endforeach
                </tr>
@endforeach
                <tr>
                    <td colspan="7" class="text-right">{{ $total_worked_hours }}</td>
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
