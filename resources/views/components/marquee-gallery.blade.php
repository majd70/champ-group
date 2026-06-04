@props([
    'id' => 'marquee-' . uniqid(),
    'eyebrow' => null,
    'title' => null,
    'subtitle' => null,
    'images' => [],
    'speed' => '60s',
])

@php
    // Split into two rows for opposite-direction scroll
    $half = (int) ceil(count($images) / 2);
    $row1 = array_slice($images, 0, $half);
    $row2 = array_slice($images, $half);
    if (empty($row2)) $row2 = $row1;
@endphp

<div class="marquee-gallery" data-gallery-root="{{ $id }}">

    {{-- header (eyebrow + title + subtitle) --}}
    @if ($eyebrow || $title || $subtitle)
        <div class="mx-auto w-full max-w-[1440px] px-6 md:px-12">
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

    {{-- ambient particles for premium feel --}}
    <div aria-hidden="true" class="pointer-events-none relative mt-10 h-0 overflow-visible">
        @for ($p = 0; $p < 6; $p++)
            <span class="showcase-particle" style="--p-delay: {{ $p * 1.4 }}s; --p-x: {{ (10 + $p * 17) % 100 }}%; --p-size: {{ 2 + ($p % 3) }}px;"></span>
        @endfor
    </div>

    {{-- ROW 1: scrolls leftwards --}}
    <div class="marquee-row mt-10" style="--marquee-speed: {{ $speed }};">
        <div class="marquee-track marquee-track--left">
            @foreach ($row1 as $i => $img)
                <button
                    type="button"
                    data-gallery-item
                    data-src="{{ $img['src'] }}"
                    data-title=""
                    class="marquee-card"
                    aria-label="Open image {{ $i + 1 }}"
                >
                    <img src="{{ $img['src'] }}" alt="" loading="lazy" decoding="async" draggable="false">
                </button>
            @endforeach
            {{-- duplicate set (decorative, not interactive, not in lightbox queue) --}}
            @foreach ($row1 as $i => $img)
                <div class="marquee-card marquee-card--ghost" aria-hidden="true">
                    <img src="{{ $img['src'] }}" alt="" loading="lazy" decoding="async" draggable="false">
                </div>
            @endforeach
        </div>
    </div>

    {{-- ROW 2: scrolls rightwards --}}
    <div class="marquee-row mt-4 md:mt-5" style="--marquee-speed: {{ $speed }};">
        <div class="marquee-track marquee-track--right">
            @foreach ($row2 as $i => $img)
                <button
                    type="button"
                    data-gallery-item
                    data-src="{{ $img['src'] }}"
                    data-title=""
                    class="marquee-card"
                    aria-label="Open image {{ count($row1) + $i + 1 }}"
                >
                    <img src="{{ $img['src'] }}" alt="" loading="lazy" decoding="async" draggable="false">
                </button>
            @endforeach
            @foreach ($row2 as $i => $img)
                <div class="marquee-card marquee-card--ghost" aria-hidden="true">
                    <img src="{{ $img['src'] }}" alt="" loading="lazy" decoding="async" draggable="false">
                </div>
            @endforeach
        </div>
    </div>
</div>
