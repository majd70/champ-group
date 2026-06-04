@props([
    'id' => 'story-' . uniqid(),
    'eyebrow' => null,
    'title' => null,
    'subtitle' => null,
    'items' => [],
    'slideVh' => 90,
])

@php
    $count = count($items);
    $totalVh = max(100, $count * $slideVh);
@endphp

<section class="sticky-story" data-sticky-story data-sticky-id="{{ $id }}" style="height: {{ $totalVh }}vh;">

    {{-- sticky stage — locked to viewport while user scrolls through the section --}}
    <div class="sticky-story__sticky">

        {{-- slides --}}
        @foreach ($items as $i => $item)
            <div
                class="sticky-story__slide {{ $i === 0 ? 'is-active' : '' }}"
                data-sticky-slide="{{ $i }}"
                aria-hidden="{{ $i === 0 ? 'false' : 'true' }}"
            >
                <img
                    src="{{ $item['src'] }}"
                    alt=""
                    loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                    decoding="async"
                    draggable="false"
                    class="sticky-story__img"
                >
            </div>
        @endforeach

        {{-- gradients for legibility --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/55 via-black/10 to-black/40"></div>
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-r from-black/55 via-transparent to-transparent"></div>

        {{-- inset gold hairline frame --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-4 rounded-2xl border border-[var(--color-accent-gold)]/15 md:inset-6"></div>

        {{-- ambient gold particles --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
            @for ($p = 0; $p < 8; $p++)
                <span class="showcase-particle" style="--p-delay: {{ $p * 1.1 }}s; --p-x: {{ (15 + $p * 11) % 100 }}%; --p-size: {{ 2 + ($p % 3) }}px;"></span>
            @endfor
        </div>

        {{-- header overlay (top-start) --}}
        @if ($eyebrow || $title || $subtitle)
            <div class="absolute start-6 top-8 z-10 max-w-[80%] md:start-12 md:top-12 lg:max-w-[640px]">
                @if ($eyebrow)
                    <div class="flex items-center gap-3">
                        <span aria-hidden="true" class="inline-block h-1.5 w-1.5 rounded-full bg-[var(--color-accent-gold)]"></span>
                        <x-eyebrow tone="gold">{{ $eyebrow }}</x-eyebrow>
                    </div>
                @endif
                @if ($title)
                    <h3 class="mt-3 text-[clamp(36px,5vw,72px)] leading-[0.95] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">{{ $title }}</h3>
                @endif
                @if ($subtitle)
                    <p class="mt-3 max-w-[52ch] text-[13px] leading-[1.6] text-white/70 md:text-[14px]">{{ $subtitle }}</p>
                @endif
            </div>
        @endif

        {{-- counter (top-end) --}}
        <div class="absolute end-6 top-8 z-10 inline-flex items-center gap-2 rounded-full border border-white/15 bg-black/35 px-3 py-1.5 backdrop-blur-md md:end-12 md:top-12">
            <span class="text-[11px] font-medium tabular-nums tracking-[0.2em] text-[var(--color-accent-gold)]" data-sticky-counter>01</span>
            <span aria-hidden="true" class="h-px w-3 bg-white/30"></span>
            <span class="text-[11px] font-medium tabular-nums tracking-[0.2em] text-white/55">{{ str_pad((string) $count, 2, '0', STR_PAD_LEFT) }}</span>
        </div>

        {{-- side progress dots (vertical, end-aligned) --}}
        <div class="absolute end-6 top-1/2 z-10 hidden -translate-y-1/2 md:flex md:end-10">
            <div class="flex flex-col items-center gap-3">
                @foreach ($items as $i => $item)
                    <button
                        type="button"
                        class="sticky-story__dot {{ $i === 0 ? 'is-active' : '' }}"
                        data-sticky-dot="{{ $i }}"
                        aria-label="Jump to slide {{ $i + 1 }}"
                    ></button>
                @endforeach
            </div>
        </div>

        {{-- scroll cue (bottom-center, hides after scrolling) --}}
        <div class="sticky-story__cue absolute inset-x-0 bottom-8 z-10 flex flex-col items-center gap-2 text-white/70 md:bottom-12" data-sticky-cue>
            <span class="text-[10px] uppercase tracking-[0.32em]">Scroll</span>
            <svg width="14" height="22" viewBox="0 0 14 22" fill="none" aria-hidden="true">
                <rect x="0.75" y="0.75" width="12.5" height="20.5" rx="6.25" stroke="currentColor" stroke-width="1.2"/>
                <circle cx="7" cy="6" r="1.6" fill="currentColor">
                    <animate attributeName="cy" values="6;14;6" dur="1.8s" repeatCount="indefinite"/>
                    <animate attributeName="opacity" values="1;0.2;1" dur="1.8s" repeatCount="indefinite"/>
                </circle>
            </svg>
        </div>
    </div>
</section>
