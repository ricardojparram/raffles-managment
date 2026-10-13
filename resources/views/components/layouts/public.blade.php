<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Rifas' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @filamentStyles
    </head>
    <body class="bg-gray-50 text-gray-900 font-sans antialiased">
        <main class="min-h-screen">
            {{ $slot }}
        </main>
        
        @livewireScripts
        @filamentScripts
        @livewire('notifications')
    </body>
</html>
