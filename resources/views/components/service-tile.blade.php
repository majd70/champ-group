@props([
    'index' => '01',
    'variant' => 'navy',
    'title' => '',
    'description' => '',
])

@php
    $isGold = $variant === 'gold';
    $surface    = $isGold ? 'bg-[var(--color-accent-gold)]' : 'bg-[var(--color-surface-navy)]';
    $indexColor = $isGold ? 'text-[var(--color-bg-navy)]/55' : 'text-[var(--color-text-dim)]';
    $titleColor = $isGold ? 'text-[var(--color-bg-navy)]'    : 'text-[var(--color-display-cream)]';
    $bodyColor  = $isGold ? 'text-[var(--color-bg-navy)]/80' : 'text-[var(--color-text-muted)]';
@endphp

<article {{ $attributes->class([
    'flex h-full min-h-[200px] flex-col gap-5 px-7 py-7 md:min-h-[220px] md:gap-6 md:px-8 md:py-8',
    $surface,
]) }}>
    <span class="text-eyebrow tabular-nums {{ $indexColor }}">{{ $index }}</span>

    <div class="flex flex-col gap-3">
        <h3 class="text-[clamp(22px,2.3vw,32px)] uppercase leading-[1.02] {{ $titleColor }}" style="font-family: var(--font-display);">
            {{ $title }}
        </h3>
        <p class="max-w-[36ch] text-[13px] leading-[1.55] {{ $bodyColor }} md:text-[13.5px]">
            {{ $description }}
        </p>
    </div>
</article>
