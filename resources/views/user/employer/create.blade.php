@extends('layouts.base')

@section('title', 'Dodawanie pracodawcy')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-plus"></i> Dodawanie pracodawcy
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <form action="{{ route('employers.store') }}" method="POST">

                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Imię</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="np. Jan" autofocus required>
@if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
@else
                                            <small id="name_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="company" class="col-sm-2 col-form-label">Nazwa firmy</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="company" name="company" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" value="{{ old('company') }}" placeholder="np. Jastrząb sp. z o.o.">
@if ($errors->has('company'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company') }}</strong>
                                            </span>
@else
                                            <small id="company_help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nip" class="col-sm-2 col-form-label"><abbr title="Numer identyfikacji podatkowej">NIP</abbr></label>
                                        <div class="col-sm-10">
                                            <input type="number" id="nip" name="nip" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" value="{{ old('nip') }}" placeholder="">
@if ($errors->has('nip'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nip') }}</strong>
                                            </span>
@else
                                            <small id="nip_help" class="form-text text-muted">Dziesięć cyfr. Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="street" class="col-sm-2 col-form-label">Ulica i numer domu / lokalu</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="street" name="street" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" value="{{ old('street') }}" placeholder="">
@if ($errors->has('street'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('street') }}</strong>
                                            </span>
@else
                                            <small id="street_help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="zip_code" class="col-sm-2 col-form-label">Kod pocztowy</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="zip_code" name="zip_code" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" value="{{ old('zip_code') }}" placeholder="np. 00-001">
@if ($errors->has('zip_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('zip_code') }}</strong>
                                            </span>
@else
                                            <small id="zip_code_help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="city" class="col-sm-2 col-form-label">Miasto</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="city" name="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{ old('city') }}" placeholder="np. Warszawa">
@if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
@else
                                            <small id="city_help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="province_id" class="col-sm-2 col-form-label">Województwo</label>
                                        <div class="col-sm-10">
                                            <select id="province_id" name="province_id" class="form-control{{ $errors->has('province_id') ? ' is-invalid' : '' }}">
@foreach ($provinces as $province)
                                                <option value="{{ $province->id }}" @if (old('province_id') == $province->id)selected @endif>{{ $province->name }}</option>
@endforeach
                                            </select>
@if ($errors->has('province_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('province_id') }}</strong>
                                            </span>
@else
                                            <small id="province_id_help" class="form-text text-muted">Pole nieobowiązkowe</small>
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
                                            <small id="email_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">Hasło</label>
                                        <div class="col-sm-10">
                                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="" placeholder="np. Jan1879Ko" required>
@if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
@else
                                            <small id="password_help" class="form-text text-muted">Pole obowiązkowe. Minimum 8 znaków. Litery, cyfry, znaki specjalne</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-sm-2 col-form-label">Powtórz hasło</label>
                                        <div class="col-sm-10">
                                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control" value="" placeholder="np. Jan1879Ko" minlength="8">
@if ($errors->has('password-confirm'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password-confirm') }}</strong>
                                            </span>
@else
                                            <small id="password_confirm_help" class="form-text text-muted">Pole obowiązkowe.</small>
@endif
                                        </div>
                                    </div>

                                    <a href="{{ route('employers.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
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
