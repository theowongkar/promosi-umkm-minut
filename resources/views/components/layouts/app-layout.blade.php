<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Metadata --}}
    <meta name="description"
        content="Website Promosi UMKM Minahasa Utara, Sulawesi Utara. Aplikasi promosi umkm berbasis website di Kabupaten Minahasa Utara.">
    <meta name="keywords" content="Promosi UMKM Minut, promosi umkm, media promosi">
    <meta name="author" content="Andini Nongka">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="Promosi UMKM Minut - {{ $title }}">
    <meta property="og:description" content="Website Promosi UMKM Minahasa Utara, Sulawesi Utara.">
    <meta property="og:image" content="{{ asset('img/hero-image.webp') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="robots" content="noindex, nofollow">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('img/application-logo.svg') }}" type="image/x-icon">

    {{-- Judul Halaman --}}
    <title>Promosi UMKM Minut</title>

    {{-- Framework Frontend --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Script Tambahan --}}
    @stack('scripts')

    {{-- Default CSS --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased">

    <div x-data="{ sidebarOpen: false }" class="relative h-screen flex overflow-hidden" x-cloak>

        {{-- Navigasi --}}
        @include('components.layouts.partials.app-navigation')

        {{-- Layout Utama --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Header --}}
            @include('components.layouts.partials.app-header')

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-5 bg-gray-200">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>

</html>
