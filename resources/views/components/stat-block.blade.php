@props([
    'number' => '',
    'unit' => null,
    'label' => '',
])

<div {{ $attributes->class(['flex flex-col gap-3']) }}>
    <div class="flex items-start gap-0.5 text-[var(--color-accent-gold)] tabular-nums">
        <span class="stat-counter text-stat-number leading-none">{{ $number }}</span>
        @if ($unit)
            <span class="mt-2 text-[0.55em] font-display uppercase tracking-wider text-[var(--color-accent-gold)]">{{ $unit }}</span>
        @endif
    </div>
    <div class="text-eyebrow text-white">{{ $label }}</div>
</div>
