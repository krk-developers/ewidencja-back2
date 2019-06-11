@extends('layouts.base')

@section('title', 'Logowanie')

@section('nav')
@endsection

@section('css')
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
            @include('includes.logo')
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row justify-content-center">
                    <!-- <label for="email" class="col-sm-2 col-form-label text-right">E-mail</label> -->
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
                    <!-- <label for="password" class="col-sm-2 col-form-label text-right">Hasło</label> -->
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
                    <!-- <div class="col-sm-2 text-right">Zapamiętaj mnie</div> -->
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input type="checkbox" id="remember" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Zapamiętaj mnie</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-sm-6 text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Zaloguj</button>
                    </div>
                </div>
            </form>
@endsection

@section('footer')
@endsection
