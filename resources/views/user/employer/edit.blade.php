@extends('layouts.base')

@section('title', 'Edycja pracodawcy')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-edit"></i> Edycja pracodawcy
                        </div>
                        <div class="card-body">
                                <form action="{{ route('employers.update', $employer->id) }}" method="POST">
                                    @method('PUT')

                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Imię</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $employer->user->name }}" placeholder="np. Jan" autofocus> <!-- required -->
@if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
@else
                                            <small id="name-help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="company" class="col-sm-2 col-form-label">Nazwa firmy</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="company" name="company" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" value="{{ $employer->company }}" placeholder="np. Jastrząb sp. z o.o.">
@if ($errors->has('company'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company') }}</strong>
                                            </span>
@else
                                            <small id="company-help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                                        <div class="col-sm-10">
                                            <input type="number" id="nip" name="nip" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" value="{{ $employer->nip }}" placeholder="">
@if ($errors->has('nip'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nip') }}</strong>
                                            </span>
@else
                                            <small id="nip-help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="street" class="col-sm-2 col-form-label">Ulica</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="street" name="street" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" value="{{ $employer->street }}" placeholder="">
@if ($errors->has('street'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('street') }}</strong>
                                            </span>
@else
                                            <small id="street-help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="zip_code" class="col-sm-2 col-form-label">Kod pocztowy</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="zip_code" name="zip_code" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" value="{{ $employer->zip_code }}" placeholder="np. 00-001">
@if ($errors->has('zip_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('zip_code') }}</strong>
                                            </span>
@else
                                            <small id="zip-code-help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="city" class="col-sm-2 col-form-label">Miasto</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="city" name="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{ $employer->city }}" placeholder="">
@if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
@else
                                            <small id="zip-code-help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="province" class="col-sm-2 col-form-label">Województwo</label>
                                        <div class="col-sm-10">
                                            <select id="province_id" name="province_id" class="form-control{{ $errors->has('province_id') ? ' is-invalid' : '' }}">
                                                <option value="">Wybierz z listy</option>
@foreach ($provinces as $province)
                                                <option value="{{ $province->id }}"@if($employer->province_id == $province->id) selected @endif>{{ $province->name }}</option>
@endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <input type="email" id="email" name="email" class="form-control" value="{{ $employer->user->email }}" readonly>
                                            <small id="email-help" class="form-text text-muted">Pola nie można edytować</small>
                                        </div>
                                    </div>

                                    <a href="{{ route('employers.show', $employer->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                        <i class="fas fa-angle-left"></i> Powrót
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Zapisz
                                    </button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection
