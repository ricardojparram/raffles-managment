@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'url' => null,
])

@php
    $pageTitle = filled($title) ? $title.' · '.config('app.name') : config('app.name');
    $pageUrl = $url ?? url()->current();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="color-scheme" content="light dark">
        <meta name="theme-color" content="#f7f5f0" media="(prefers-color-scheme: light)">
        <meta name="theme-color" content="#12100c" media="(prefers-color-scheme: dark)">
        <meta name="format-detection" content="telephone=no">

        <title>{{ $pageTitle }}</title>
        <link rel="canonical" href="{{ $pageUrl }}">

        @if (filled($description))
            <meta name="description" content="{{ $description }}">
            <meta property="og:description" content="{{ $description }}">
        @endif

        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:locale" content="es_VE">
        <meta property="og:title" content="{{ $title ?? config('app.name') }}">
        <meta property="og:url" content="{{ $pageUrl }}">

        @if (filled($image))
            <meta property="og:image" content="{{ $image }}">
            <meta name="twitter:card" content="summary_large_image">
        @else
            <meta name="twitter:card" content="summary">
        @endif

        @vite(['resources/css/public.css', 'resources/js/public.js'])
    </head>
    <body class="bg-canvas text-ink min-h-dvh font-sans antialiased">
        {{ $slot }}
    </body>
</html>
