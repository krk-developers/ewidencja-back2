@extends('layouts.print')

@section('title', 'Ewidencja indywidualna ' . $worker->user->name. ' ' . $worker->lastname . ' ' . $employer->company . ' ' . $yearMonth)

@section('content')
        <table class="header">
            <tbody>
                <tr>
                    <td>{{ $worker->user->name }} {{ $worker->lastname }}</td>
                    <td>PESEL: {{ $worker->pesel }}</td>
                    <td>Pracodawca: {{ $employer->company }}</td>
                    <td>Okres: {{ $yearMonth }}</td>
                    <td>Kwota ekwiwalentu: {{ $worker->equivalent_amount }}</td>
                    <td>Etat: {{ $worker->effective }}</td>
                </tr>
            </tbody>
        </table>

        <table class="main">
            <tbody>
                <tr>
                    <td>Dni w miesiącu: {{ $days_in_month }}</td>
                    <td>Dni pracujących: {{ $time_period_public_holiday_filter }}</td>
                    <td>Dni ustawowo wolnych od pracy: {{ $public_holidays_in_month->count() }}</td>
                    <td>Nieobecności: {{ $absence_in_days }}</td>                    
                    <td>Przepracowanych dni: {{ $working_days }}</td>
                    <td>Przepracowanych godzin: {{ $workingHoursDuringMonth }}</td>
                </tr>
            </tbody>
        </table>

        <table class="calendar">
            <tbody>
                <tr>
@foreach ($calendar as $key => $value)
                    <td>
                        {{ $key }}<br>{{ $value }}
                    </td>
@endforeach
                </tr>
            </tbody>
        </table>

{{--
        <table class="event">
            <caption>Nieobecności</caption>
            <thead>
                <tr>
                    <th scope="col">L.P.</th>
                    <th scope="col">Początek</th>
                    <th scope="col">Koniec</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Opis</th>
                </tr>
            </thead>
            <tbody>
@foreach ($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->start }}</td>
                    <td>{{ $event->end }}</td>
                    <td>{{ $event->legend_name }}</td>
                    <td>{{ $event->legend_display_name }}</td>
                </tr>
@endforeach
            </tbody>
        </table>
--}}
        
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