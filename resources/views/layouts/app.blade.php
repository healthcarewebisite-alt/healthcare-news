<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $ogTitle = isset($title) ? strip_tags($title) : 'Healthcare.id - Portal Berita Kesehatan Nasional';
        $ogDescription = isset($description) ? strip_tags($description) : 'Media digital kesehatan nasional: berita, edukasi, riset, inovasi, rumah sakit, teknologi kesehatan, dan kebijakan kesehatan.';
        $ogImageUrl = isset($image) && $image ? $image : asset('images/og-default.jpg');
        $ogType = $type ?? 'website';
    @endphp

    <title>{{ $ogTitle }}</title>
    <meta name="description" content="{{ $ogDescription }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- ============ Open Graph Protocol ============ --}}
    <meta property="og:site_name" content="Healthcare.id">
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImageUrl }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    {{-- Twitter Card (memakai data OG yang sama) --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDescription }}">
    <meta name="twitter:image" content="{{ $ogImageUrl }}">

    @stack('og')

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|manrope:400,600,700" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen flex flex-col bg-softbg">

    @include('partials.navbar-desktop')
    @include('partials.navbar-mobile')

    <main class="flex-1">
        {{ $slot }}
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
