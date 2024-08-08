<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $site_title }} -- {{ $title  }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="antialiased">
        <h1>Home page</h1>
        {!! $nav_menu !!}

        <ul>
            <li>User name: {{ $name }}</li>
            <li>User surname: {{ $surname }}</li>
            <li>User age: {{ $age  }}</li>
        </ul>

        <h3>{{ $data }}</h3>
    </body>
</html>
