@extends('layouts.base')

@section('title', 'Wydarzenia')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h1><i class="fas fa-calendar-alt"></i> Wydarzenia</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Skrót</th>
                                <th scope="col">Imię</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">Początek</th>
                                <th scope="col">Koniec</th>
                                <th scope="col">Pesel</th>
                                <th scope="col">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($events as $event)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->legend_name }}</td>
                                <td>{{ $event->firstname }}</td>
                                <td>{{ $event->lastname }}</td>
                                <td>{{ $event->start }}</td>
                                <td>{{ $event->end }}</td>
                                <td>{{ $event->pesel }}</td>
                                <td>{{ $event->email }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
