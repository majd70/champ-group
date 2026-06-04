@props([
    'id' => 'coverflow-' . uniqid(),
    'eyebrow' => null,
    'title' => null,
    'subtitle' => null,
    'items' => [],
    'autoplay' => 4500,
])

@php
    $count = count($items);
@endphp

<section class="coverflow-section" data-gallery-root="{{ $id }}">

    {{-- header --}}
    @if ($eyebrow || $title || $subtitle)
        <div class="mx-auto mb-10 w-full max-w-[1440px] px-6 md:mb-14 md:px-12">
            @if ($eyebrow)
                <div class="flex items-center gap-3">
                    <span aria-hidden="true" class="inline-block h-1.5 w-1.5 rounded-full bg-[var(--color-accent-gold)]"></span>
                    <x-eyebrow tone="gold">{{ $eyebrow }}</x-eyebrow>
                </div>
            @endif
            @if ($title)
                <h3 class="mt-3 text-display-xxl text-[var(--color-display-cream)]">{{ $title }}</h3>
            @endif
            @if ($subtitle)
                <p class="mt-4 max-w-[60ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    {{-- ambient gold particles --}}
    <div aria-hidden="true" class="pointer-events-none relative h-0 overflow-visible">
        @for ($p = 0; $p < 8; $p++)
            <span class="showcase-particle" style="--p-delay: {{ $p * 1.2 }}s; --p-x: {{ (12 + $p * 13) % 100 }}%; --p-size: {{ 2 + ($p % 3) }}px;"></span>
        @endfor
    </div>

    {{-- stage --}}
    <div
        class="coverflow relative w-full"
        data-coverflow
        data-coverflow-id="{{ $id }}"
        data-autoplay="{{ $autoplay }}"
        data-count="{{ $count }}"
        role="region"
        aria-roledescription="carousel"
        aria-label="Image carousel"
        tabindex="0"
    >
        <div class="coverflow__stage">
            @foreach ($items as $i => $item)
                <button
                    type="button"
                    data-coverflow-item="{{ $i }}"
                    data-gallery-item
                    data-src="{{ $item['src'] }}"
                    data-title=""
                    class="coverflow__item"
                    aria-label="View image {{ $i + 1 }}"
                >
                    <img src="{{ $item['src'] }}" alt="" loading="{{ $i < 3 ? 'eager' : 'lazy' }}" decoding="async" draggable="false">
                    <span aria-hidden="true" class="coverflow__shine"></span>
                </button>
            @endforeach
        </div>

        {{-- arrows --}}
        <button
            type="button"
            class="coverflow__arrow coverflow__arrow--prev"
            data-coverflow-prev
            aria-label="Previous image"
        >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="rtl:rotate-180" aria-hidden="true">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        <button
            type="button"
            class="coverflow__arrow coverflow__arrow--next"
            data-coverflow-next
            aria-label="Next image"
        >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="rtl:rotate-180" aria-hidden="true">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>

        {{-- counter + dots --}}
        <div class="mt-8 flex flex-col items-center gap-4">
            <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-black/30 px-3 py-1 backdrop-blur-md">
                <span class="text-[11px] font-medium tabular-nums tracking-[0.2em] text-[var(--color-accent-gold)]" data-coverflow-counter>01</span>
                <span aria-hidden="true" class="h-px w-3 bg-white/30"></span>
                <span class="text-[11px] font-medium tabular-nums tracking-[0.2em] text-white/55">{{ str_pad((string) $count, 2, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex items-center gap-1.5">
                @foreach ($items as $i => $item)
                    <button
                        type="button"
                        class="coverflow__dot {{ $i === 0 ? 'is-active' : '' }}"
                        data-coverflow-dot="{{ $i }}"
                        aria-label="Go to image {{ $i + 1 }}"
                    ></button>
                @endforeach
            </div>
        </div>
    </div>
</section>
