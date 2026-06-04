@props([
    'index' => '01',
    'total' => '12',
    'label' => '',
])

<div {{ $attributes->class(['flex items-center gap-3']) }}>
    <span class="text-eyebrow text-[var(--color-text-dim)]">{{ $label }}</span>
</div>
