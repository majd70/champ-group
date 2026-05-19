@php
    $currentLocale = app()->getLocale();
    $localeData = config('app.available_locales.' . $currentLocale, ['dir' => 'ltr']);
@endphp
<!DOCTYPE html>
<html lang="{{ $currentLocale }}" dir="{{ $localeData['dir'] ?? 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Champions Group — a diversified sports ecosystem advancing the sports sector in MENA since 2015.')">
    <title>@yield('title', 'Champions Group')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Serif+Display:ital@0;1&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- RTL/Arabic — load Tajawal which has full Arabic + Latin glyph coverage --}}
    @if (($localeData['dir'] ?? 'ltr') === 'rtl')
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
    @endif

    {{-- Alpine.js for the language switcher dropdown (and any future small interactions) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--color-bg-navy)] text-[var(--color-text-muted)] antialiased">
    <x-navbar />
    <main class="pt-[60px] md:pt-[72px]">
        @yield('content')
    </main>
    <x-footer />

    {{-- GSAP + ScrollTrigger via CDN, then site animations --}}
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="{{ asset('js/animations.js') }}"></script>
</body>
</html>
