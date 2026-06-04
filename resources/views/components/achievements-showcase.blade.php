@props([
    'id' => 'showcase-' . uniqid(),
    'badge' => 'Achievement',
    'cta' => 'View Achievement',
    'autoplay' => 5000,
    'items' => [],
])

@php
    $hasItems = !empty($items);
@endphp

<div
    class="achievements-showcase relative w-full"
    data-showcase
    data-showcase-id="{{ $id }}"
    data-autoplay="{{ $autoplay }}"
    role="region"
    aria-roledescription="carousel"
    aria-label="Achievements showcase"
>

    {{-- ambient floating particles --}}
    <div aria-hidden="true" class="showcase-particles pointer-events-none absolute inset-0 overflow-hidden">
        @for ($p = 0; $p < 12; $p++)
            <span class="showcase-particle" style="--p-delay: {{ $p * 0.6 }}s; --p-x: {{ ($p * 37) % 100 }}%; --p-size: {{ 2 + ($p % 4) }}px;"></span>
        @endfor
    </div>

    @if ($hasItems)
        {{-- ============== HERO STAGE ============== --}}
        <div
            class="showcase-stage relative w-full overflow-hidden"
            data-showcase-stage
            tabindex="0"
            aria-label="Featured achievement"
        >
            @foreach ($items as $i => $item)
                <div
                    class="showcase-slide absolute inset-0 transition-opacity duration-[1200ms] ease-in-out {{ $i === 0 ? 'is-active opacity-100 z-10' : 'opacity-0 z-0' }}"
                    data-slide="{{ $i }}"
                    role="group"
                    aria-roledescription="slide"
                    aria-label="{{ ($i + 1) }} of {{ count($items) }}"
                    aria-hidden="{{ $i === 0 ? 'false' : 'true' }}"
                >
                    {{-- cinematic image (ken-burns when active) --}}
                    <div class="showcase-slide__image-wrap absolute inset-0">
                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['title'] ?? '' }}"
                            loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                            decoding="async"
                            draggable="false"
                            class="showcase-slide__image h-full w-full object-cover"
                        >
                    </div>

                    {{-- dark gradient overlay --}}
                    <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-r from-[#06143A] via-[#06143A]/85 to-transparent"></div>
                    <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-t from-[#06143A] via-transparent to-transparent"></div>

                    {{-- content overlay (left side, swaps for RTL) --}}
                    <div class="relative z-10 flex h-full items-center">
                        <div class="mx-auto w-full max-w-[1440px] px-6 md:px-12">
                            <div class="showcase-slide__content max-w-[640px]">

                                {{-- badge --}}
                                <div class="showcase-badge inline-flex items-center gap-2 rounded-full border border-[var(--color-accent-gold)]/40 bg-[var(--color-accent-gold)]/10 px-3 py-1 backdrop-blur-md">
                                    <span aria-hidden="true" class="inline-block h-1.5 w-1.5 rounded-full bg-[var(--color-accent-gold)]"></span>
                                    <span class="text-[10.5px] font-medium uppercase tracking-[0.22em] text-[var(--color-accent-gold)]">
                                        {{ $badge }}
                                    </span>
                                </div>

                                {{-- title --}}
                                <h3 class="showcase-title mt-5 text-[clamp(40px,6vw,96px)] leading-[0.92] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">
                                    {{ $item['title'] ?? '' }}
                                </h3>

                                {{-- description --}}
                                @if (!empty($item['description']))
                                    <p class="showcase-desc mt-5 max-w-[52ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                                        {{ $item['description'] }}
                                    </p>
                                @endif

                                {{-- year + CTA --}}
                                <div class="showcase-meta mt-7 flex items-center gap-5">
                                    @if (!empty($item['year']))
                                        <span class="text-eyebrow text-[var(--color-accent-gold)]">{{ $item['year'] }}</span>
                                    @endif
                                    <span aria-hidden="true" class="h-px w-10 bg-white/20"></span>
                                    @if (!empty($item['link']))
                                        <a
                                            href="{{ $item['link'] }}"
                                            class="showcase-cta group inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/[0.06] px-6 py-2.5 text-[13px] font-medium uppercase tracking-[0.16em] text-white backdrop-blur-md transition-all duration-300 hover:border-[var(--color-accent-gold)]/60 hover:bg-[var(--color-accent-gold)]/15 hover:text-[var(--color-accent-gold)]"
                                        >
                                            <span>{{ $cta }}</span>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-300 group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </a>
                                    @else
                                        <button
                                            type="button"
                                            class="showcase-cta group inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/[0.06] px-6 py-2.5 text-[13px] font-medium uppercase tracking-[0.16em] text-white backdrop-blur-md transition-all duration-300 hover:border-[var(--color-accent-gold)]/60 hover:bg-[var(--color-accent-gold)]/15 hover:text-[var(--color-accent-gold)]"
                                        >
                                            <span>{{ $cta }}</span>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-300 group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- prev / next arrows --}}
            <button
                type="button"
                class="showcase-arrow showcase-arrow--prev absolute top-1/2 z-20 -translate-y-1/2"
                data-showcase-prev
                aria-label="Previous achievement"
            >
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button
                type="button"
                class="showcase-arrow showcase-arrow--next absolute top-1/2 z-20 -translate-y-1/2"
                data-showcase-next
                aria-label="Next achievement"
            >
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>

            {{-- bottom progress strip --}}
            <div aria-hidden="true" class="absolute inset-x-0 bottom-0 z-20 h-[2px] bg-white/10">
                <div class="showcase-progress h-full bg-[var(--color-accent-gold)]" data-showcase-progress></div>
            </div>
        </div>

        {{-- ============== THUMBNAILS ============== --}}
        <div class="showcase-thumbs-wrap relative z-20">
            <div class="mx-auto w-full max-w-[1440px] px-6 md:px-12">
                <div
                    class="showcase-thumbs flex gap-3 overflow-x-auto pb-2 pt-6 md:gap-4 md:pt-8"
                    data-showcase-thumbs
                    role="tablist"
                    aria-label="Achievement thumbnails"
                >
                    @foreach ($items as $i => $item)
                        <button
                            type="button"
                            class="showcase-thumb group relative shrink-0 overflow-hidden rounded-xl border border-white/10 transition-all duration-300 {{ $i === 0 ? 'is-active' : '' }}"
                            data-showcase-thumb="{{ $i }}"
                            role="tab"
                            aria-selected="{{ $i === 0 ? 'true' : 'false' }}"
                            aria-label="View: {{ $item['title'] ?? 'Achievement ' . ($i + 1) }}"
                        >
                            <div class="aspect-[16/10] w-[150px] md:w-[180px] lg:w-[210px]">
                                <img
                                    src="{{ $item['image'] }}"
                                    alt=""
                                    loading="lazy"
                                    decoding="async"
                                    draggable="false"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                >
                            </div>
                            <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                            <div class="pointer-events-none absolute inset-x-0 bottom-0 px-3 py-2 text-start">
                                <div class="truncate text-[11px] font-medium text-white">{{ $item['title'] ?? '' }}</div>
                                @if (!empty($item['year']))
                                    <div class="text-[9.5px] uppercase tracking-[0.18em] text-[var(--color-accent-gold)]/90">{{ $item['year'] }}</div>
                                @endif
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        {{-- empty placeholder hero --}}
        <div class="showcase-stage relative w-full overflow-hidden">
            <div class="gallery-skeleton absolute inset-0"></div>
            <div class="relative z-10 flex min-h-[60vh] items-center">
                <div class="mx-auto w-full max-w-[1440px] px-6 md:px-12">
                    <div class="max-w-[640px] space-y-5">
                        <div class="gallery-skeleton h-6 w-32 rounded-full"></div>
                        <div class="gallery-skeleton h-16 w-3/4 rounded-lg"></div>
                        <div class="gallery-skeleton h-4 w-full rounded"></div>
                        <div class="gallery-skeleton h-4 w-5/6 rounded"></div>
                        <div class="gallery-skeleton h-10 w-48 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
