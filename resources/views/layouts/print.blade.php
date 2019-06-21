<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">                
        <title>@yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=PT+Mono&display=swap" rel="stylesheet">
        <link href="{{ asset('css/print.css') }}" rel="stylesheet">
    </head>
    <body>
@yield('content')
    </body>
</html>