<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="page-wrapper">
            @include('layouts.navigation')

            @isset($header)
                <header class="page-header">
                    <div class="container">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="page-content">
                <div class="container section">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
