@props([
    'index' => '01',
    'total' => '12',
    'label' => '',
])

<div {{ $attributes->class(['flex items-center gap-3']) }}>
    <span class="inline-flex h-5 w-5 items-center justify-center rounded-sm bg-[var(--color-accent-gold)] text-[10px] font-semibold text-[var(--color-bg-navy)] tabular-nums">
        {{ $index }}
    </span>
    <span class="text-eyebrow text-[var(--color-text-dim)]">{{ $label }}</span>
</div>
