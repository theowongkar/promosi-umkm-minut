<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Default Metadata (Fallback) --}}
    <meta name="description"
        content="{{ $meta_description ?? 'Website Promosi UMKM Minahasa Utara, Sulawesi Utara. Aplikasi promosi umkm berbasis website di Kabupaten Minahasa Utara.' }}">
    <meta name="keywords" content="{{ $meta_keywords ?? 'Promosi UMKM Minut, promosi umkm, media promosi, umkm minut' }}">
    <meta name="author" content="Promosi UMKM Minut">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Default OG Tags (fallback) --}}
    <meta property="og:title" content="{{ $meta_title ?? 'Promosi UMKM Minut' }}">
    <meta property="og:description" content="{{ $meta_description ?? 'Website Promosi UMKM Minahasa Utara.' }}">
    <meta property="og:image" content="{{ $meta_image ?? asset('img/hero-image.webp') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('img/application-logo.svg') }}" type="image/x-icon">

    {{-- Dynamic Title --}}
    <title>{{ $title ?? 'Promosi UMKM Minut' }}</title>

    {{-- Framework Frontend --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Additional META from specific pages (SEO per halaman) --}}
    @stack('meta')

    {{-- Script Tambahan --}}
    @stack('scripts')

    {{-- Default CSS --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased">

    <div class="flex flex-col min-h-screen">
        {{-- Navigasi --}}
        @include('components.layouts.partials.guest-navigation')

        {{-- Layout Utama --}}
        <main class="flex-1 bg-gray-50">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        @include('components.layouts.partials.guest-footer')
    </div>

</body>

</html>
