@extends('layouts.base')

@section('title', $legend->name)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-calendar-day"></i>
                            Legenda
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <table class="table">
                                        <tr>
                                            <th scope="row">#</th>
                                            <td>{{ $legend->id }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Skrót</th>
                                            <td>{{ $legend->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nazwa</th>
                                            <td>{{ $legend->display_name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Opis</th>
                                            <td>{{ $legend->description }}</td>
                                        </tr>
                                </table>
                            </p>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('legends.destroy', $legend->id) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <a href="{{ route('legends.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
                                <a href="{{ route('legends.edit', $legend->id) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edytuj
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-calendar-minus"></i> Usuń
                                </button>
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
