@extends('layouts.base')

@section('title', 'Legenda')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-calendar"></i> Legenda</h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Skrót</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Opis</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($legends as $legend)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $legend->id }}</td>
                                <td>{{ $legend->name }}</td>
                                <td>{{ $legend->display_name }}</td>
                                <td>{{ $legend->description }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
