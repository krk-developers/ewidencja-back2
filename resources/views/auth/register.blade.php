@extends('layouts.base')

@section('title', 'Zakładanie konta')

@section('nav')
@endsection

@section('css')
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
            @include('includes.logo')
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row justify-content-center">
                    <label for="name" class="col-sm-2 col-form-label text-right">Imię</label>
                    <div class="col-sm-6">
                        <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Imię" autofocus> <!-- required -->
@if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
@endif
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label for="userable_type" class="col-sm-2 col-form-label text-right">Typ użytkownika</label>
                    <div class="col-sm-6">
                        <select id="userable_type" name="userable_type" class="form-control">
                            <option value="App\Worker">Pracownik</option>
                            <option value="App\Employer">Pracodawca</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label for="email" class="col-sm-2 col-form-label text-right">E-mail</label>
                    <div class="col-sm-6">
                        <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="E-mail" autofocus> <!-- required -->
@if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
@endif
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label for="password" class="col-sm-2 col-form-label text-right">Hasło</label>
                    <div class="col-sm-6">
                        <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Hasło"> <!-- required -->
@if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
@endif
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label for="password-confirm" class="col-sm-2 col-form-label text-right">Powtórz hasło</label>
                    <div class="col-sm-6">
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Powtórz hasło"> <!-- required -->
@if ($errors->has('password-confirm'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password-confirm') }}</strong>
                        </span>
@endif
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-sm-8 text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-id-badge"></i> Załóż</button>
                    </div>
                </div>
            </form>
@endsection

@section('footer')
@endsection
