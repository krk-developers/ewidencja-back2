<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Major+Mono+Display&amp;subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Mono">
        <link href="{{ asset('css/base.css') }}" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="16x16">
        <title>@yield('title')</title>
@section('css')
@show
    </head>
    <body>
@auth
        @include('includes.nav')
@endauth
@if (session('success'))
        @include('includes.success')
@endif
@if (session('info'))
        @include('includes.info')
@endif
@if (session('danger'))
        @include('includes.danger')
@endif
        <div class="container-fluid">
@yield('content')
        </div>
@auth
        @include('includes.footer')
@endauth
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="{{ asset('js/tooltip.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
@section('js')
@show
    </body>
</html>