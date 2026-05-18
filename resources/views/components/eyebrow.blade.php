@props([
    'tone' => 'muted',
])

@php
    $toneClass = match ($tone) {
        'gold' => 'text-[var(--color-accent-gold)]',
        'white' => 'text-white',
        'dim' => 'text-[var(--color-text-dim)]',
        default => 'text-[var(--color-text-muted)]',
    };
@endphp

<span {{ $attributes->class(['text-eyebrow', $toneClass]) }}>
    {{ $slot }}
</span>
