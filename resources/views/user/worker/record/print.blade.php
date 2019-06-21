<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">    
        <link rel="stylesheet" href="">
        <title>{{ $worker->user->name }} {{ $worker->lastname }}. {{ $employer->company }}. {{ $yearMonth }}</title>
        <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=PT+Mono&display=swap" rel="stylesheet">
        <link href="{{ asset('css/print.css') }}" rel="stylesheet">
    </head>
    <body>
        <table class="header">
            <tbody>
                <tr>
                    <td>{{ $worker->user->name }} {{ $worker->lastname }}</td>
                    <td>PESEL: {{ $worker->pesel }}</td>
                    <td>Pracodawca: {{ $employer->company }}</td>
                    <td>Okres: {{ $yearMonth }}</td>
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
                    <td></td>
                </tr>
            </tbody>
        </table>

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
        {{--
        <div class="legend">
            <table border="1">
                <tbody>
@foreach ($legendGroups[0] as $legend)
                    <tr>
                        <td>{{ $legend->name }}:</td>
                        <td>{{ $legend->display_name }}</td>
                    </tr>
@endforeach
                </tbody>
            </table>
        </div>
        <div class="legend">
            <table border="1">
                <tbody>
@foreach ($legendGroups[1] as $legend)
                    <tr>
                        <td>{{ $legend->name }}:</td>
                        <td>{{ $legend->display_name }}</td>
                    </tr>
@endforeach
                </tbody>
            </table>
        </div>
        --}}
    </body>
</html>