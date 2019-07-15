<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Ewidencja zbiorowa</title>
        <style>
            body {
                font-family: DejaVu Sans Mono, DejaVu Sans;
                font-size: 8pt;
                margin: 0;
                padding: 0;
            }

            table.header, table.main, table.collective { width: 100%; }

            table.header, table.main {
                margin-bottom: 30pt;
            }

            table.legend { font-size: 6pt; }

            table.header tbody tr td,
            table.main tbody tr td,
            table.collective tbody tr td { 
                border-top: 1px solid #777777;
                border-bottom: 2px solid #777777;
                padding-top: 3pt;
                padding-bottom: 3pt;
            }

            table.collective {
                margin-bottom: 50pt;
                font-size: 6pt;
            }
            table.collective thead tr td { border-top: 2pt solid #777777; }
            table.collective tbody tr td { border-bottom: 0; }

            div.sign {
                font-size: 7pt;
                border-top: 1px dotted #989898;
                float: left;
                width: 25%;
                padding-top: 3pt;
                margin-bottom: 25pt;
                margin-left: 5%;
                margin-right: 5%;
            }

            table.legend { margin-top: 50pt; }

            .text-right { text-align: right; }
        </style>
    </head>
    <body>
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
                    <td>Suma przepracowanych dni: {{ $total_worked_days }}</td>
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
        
        <table class="legend">
            <tbody>
@foreach ($legend as $legend_)
                <tr>
                    <td>{{ $legend_->name }}:</td>
                    <td>{{ $legend_->display_name }}</td>
                </tr>
@endforeach
            </tbody>
        </table>

    </body>
</html>