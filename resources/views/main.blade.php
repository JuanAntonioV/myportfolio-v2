<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Front-End Developer | Juan Antonio Vivaldy Saragih</title>

    @vitereactrefresh
    @vite(['resources/js/Main.jsx', 'resources/sass/main.scss'])
</head>
<body>
    <div id="app"></div>
</body>
</html>
