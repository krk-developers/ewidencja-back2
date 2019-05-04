@extends('layouts.base')

@section('title', 'Dodawanie Super Administratora')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-plus"></i> Dodawanie Super Administratora
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <form action="{{ route('superadmins.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Imię</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="np. Jan" autofocus> <!-- required -->
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
                                            <input type="text" id="lastname" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{ old('lastname') }}" placeholder="np. Kowalski"> <!-- required -->
@if ($errors->has('lastname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
@else
                                            <small id="lastnameHelp" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="np. jan.kowalski@onet.pl">
@if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
@else
                                            <small id="emailHelp" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">Hasło</label>
                                        <div class="col-sm-10">
                                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="" placeholder="np. Jan1879Ko"> <!-- required -->
@if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
@else
                                            <small id="passwordHelp" class="form-text text-muted">Pole obowiązkowe. Minimum 8 znaków. Litery, cyfry, znaki specjalne</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-sm-2 col-form-label">Powtórz hasło</label>
                                        <div class="col-sm-10">
                                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control" value="" placeholder="np. Jan1879Ko"> <!-- required -->
@if ($errors->has('password-confirm'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password-confirm') }}</strong>
                                            </span>
@else
                                            <small id="password-confirmHelp" class="form-text text-muted">Pole obowiązkowe.</small>
@endif
                                        </div>
                                    </div>

                                    <a href="{{ route('superadmins.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
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
