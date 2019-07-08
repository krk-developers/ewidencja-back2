@extends('layouts.base')

@section('title', 'Dodawanie pracownika')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-plus"></i> Dodawanie pracownika
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <form action="{{ route('workers.store') }}" method="POST">

                                    @csrf

                                    {{--
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Typ użytkownika</label>
                                        <div class="col-sm-10">
                                            <select id="userable_type" name="userable_type" class="form-control">
                                                <option value="App\Worker">Pracownik</option>
                                                <option value="App\Employer">Pracodawca</option>
                                            </select>
                                            <small id="userable_type_help" class="form-text text-muted">Pole obowiązkowe</small>
                                        </div>
                                    </div>
                                    --}}
                                    
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Imię</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="np. Jan" autofocus required>
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
                                        <label for="pesel" class="col-sm-2 col-form-label"><abbr title="Powszechny Elektroniczny System Ewidencji Ludności">PESEL</abbr></label>
                                        <div class="col-sm-10">
                                            <input type="number" id="pesel" name="pesel" class="form-control{{ $errors->has('pesel') ? ' is-invalid' : '' }}" value="{{ old('pesel') }}" placeholder="np. 82040303734">
@if ($errors->has('pesel'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pesel') }}</strong>
                                            </span>
@else
                                            <small id="pesel_help" class="form-text text-muted">Jedenaście cyfr. Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="np. jan.kowalski@onet.pl" required>
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
                                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="" placeholder="np. Jan1879Ko" required>
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
                                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control" value="" placeholder="np. Jan1879Ko" required>
@if ($errors->has('password-confirm'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password-confirm') }}</strong>
                                            </span>
@else
                                            <small id="password-confirmHelp" class="form-text text-muted">Pole obowiązkowe.</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="equivalent" class="col-sm-2 col-form-label">Ekwiwalent</label>
                                        <div class="col-sm-10">
                                            <select id="equivalent" name="equivalent" class="form-control{{ $errors->has('equivalent') ? ' is-invalid' : '' }}" placeholder="Ekwiwalent">
                                                <option value="0" @if (old('equivalent') == 0)selected @endif>Nie</option>
                                                <option value="1" @if (old('equivalent') == 1)selected @endif>Tak</option>
                                            </select>
@if ($errors->has('equivalent'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('equivalent') }}</strong>
                                            </span>
@else
                                            <small id="part_time_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row" id="equivalent-amount-group">
                                        <label for="equivalent_amount" class="col-sm-2 col-form-label">Kwota ekwiwalentu (PLN)</label>
                                        <div class="col-sm-10">
                                            <input type="number" id="equivalent_amount" name="equivalent_amount" class="form-control{{ $errors->has('equivalent_amount') ? ' is-invalid' : '' }}" value="0" min="0" placeholder=""> <!-- required -->
@if ($errors->has('equivalent_amount'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('equivalent_amount') }}</strong>
                                            </span>
@else
                                            <small id="equivalent_amount_help" class="form-text text-muted">Pole obowiązkowe jeśli ekwiwalent zaznaczony na tak</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="effective" class="col-sm-2 col-form-label">Etat efektywny</label>
                                        <div class="col-sm-10">
                                            <select id="effective" name="effective" class="form-control{{ $errors->has('effective') ? ' is-invalid' : '' }}" placeholder="Etat efektywny">
                                                <option value="1">1</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
@if ($errors->has('effective'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('effective') }}</strong>
                                            </span>
@else
                                            <small id="effective_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <a href="{{ route('workers.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
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
@section('js')
        <script src="{{ asset('js/equivalent.js') }}"></script>
@endsection
