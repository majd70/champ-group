<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Champions Group — a diversified sports ecosystem advancing the sports sector in MENA since 2015.')">
    <title>@yield('title', 'Champions Group')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Serif+Display:ital@0;1&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--color-bg-navy)] text-[var(--color-text-muted)] antialiased">
    <x-navbar />
    <main class="pt-[60px] md:pt-[72px]">
        @yield('content')
    </main>
    <x-footer />
</body>
</html>
