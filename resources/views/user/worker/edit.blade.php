@extends('layouts.base')

@section('title', $worker->user->name . ' ' .$worker->lastname)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-edit"></i> Edycja pracownika
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <form action="{{ route('workers.update', $worker->id) }}" method="POST">
                                    @method('PUT')

                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Imię</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $worker->user->name }}" placeholder="np. Jan" autofocus> <!-- required -->
@if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
@else
                                            <small id="nameHelp" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-2 col-form-label">Nazwisko</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="lastname" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{ $worker->lastname }}" placeholder="np. Kowalski"> <!-- required -->
@if ($errors->has('lastname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
@else
                                            <small id="lastnameHelp" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="pesel" class="col-sm-2 col-form-label">
                                            <abbr title="Powszechny Elektroniczny System Ewidencji Ludności">
                                                PESEL
                                            </abbr>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" id="pesel" name="pesel" class="form-control{{ $errors->has('pesel') ? ' is-invalid' : '' }}" value="{{ $worker->pesel }}" placeholder="np. 82040303734"> <!-- required -->
@if ($errors->has('pesel'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pesel') }}</strong>
                                            </span>
@else
                                            <small id="peselHelp" class="form-text text-muted">Tylko cyfry</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <input type="email" id="email" name="email" class="form-control" value="{{ $worker->user->email }}" readonly>
                                            <small id="emailHelp" class="form-text text-muted">Pola nie można edytować</small>
                                        </div>
                                    </div>

                                    <a href="{{ route('workers.show', $worker->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                        <i class="fas fa-angle-left"></i> Powrót
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Zapisz
                                    </button>
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
@endsection
