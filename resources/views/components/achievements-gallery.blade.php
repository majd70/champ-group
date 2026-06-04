@props([
    'id' => 'gallery-' . uniqid(),
    'eyebrow' => null,
    'title' => 'Our Achievements',
    'subtitle' => 'Moments that define our journey and success.',
    'images' => [],
])

@php
    $hasImages = !empty($images);
    $skeletonCount = 6;
@endphp

<div class="achievements-gallery" data-gallery-root="{{ $id }}">

    {{-- header --}}
    <div class="flex flex-col gap-3 mb-10 md:mb-14">
        @if ($eyebrow)
            <div class="flex items-center gap-3">
                <span aria-hidden="true" class="inline-block h-1.5 w-1.5 rounded-full bg-[var(--color-accent-gold)]"></span>
                <x-eyebrow tone="gold">{{ $eyebrow }}</x-eyebrow>
            </div>
        @endif
        <h2 class="text-display-xxl text-[var(--color-display-cream)]">
            {{ $title }}
        </h2>
        @if ($subtitle)
            <p class="max-w-[60ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                {{ $subtitle }}
            </p>
        @endif
    </div>

    {{-- masonry grid via CSS columns --}}
    <div class="gallery-masonry columns-1 gap-3 sm:columns-2 sm:gap-4 lg:columns-3 lg:gap-5 xl:columns-4 [&>*]:mb-3 sm:[&>*]:mb-4 lg:[&>*]:mb-5">

        @if ($hasImages)
            @foreach ($images as $i => $item)
                @php
                    $aspectClasses = ['aspect-[4/5]', 'aspect-[4/3]', 'aspect-square', 'aspect-[3/4]', 'aspect-[16/10]'];
                    $aspect = $aspectClasses[$i % count($aspectClasses)];
                @endphp
                <button
                    type="button"
                    data-gallery-item
                    data-index="{{ $i }}"
                    data-src="{{ $item['image'] }}"
                    data-title="{{ $item['title'] ?? '' }}"
                    data-year="{{ $item['year'] ?? '' }}"
                    class="group relative block w-full overflow-hidden rounded-2xl border border-white/10 bg-[var(--color-surface-navy)]/40 break-inside-avoid transition-all duration-500 hover:border-[var(--color-accent-gold)]/40 hover:shadow-[0_20px_60px_-15px_rgba(244,184,30,0.25)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)]"
                    aria-label="Open image: {{ $item['title'] ?? 'Achievement ' . ($i + 1) }}"
                >
                    <div class="{{ $aspect }} w-full overflow-hidden">
                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['title'] ?? '' }}"
                            loading="lazy"
                            decoding="async"
                            draggable="false"
                            class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
                        >
                    </div>

                    {{-- glassmorphism overlay (visible on hover) --}}
                    <div class="pointer-events-none absolute inset-x-0 bottom-0 translate-y-2 opacity-0 transition-all duration-500 group-hover:translate-y-0 group-hover:opacity-100">
                        <div class="m-3 rounded-xl border border-white/15 bg-black/40 px-4 py-3 backdrop-blur-md">
                            @if (!empty($item['title']))
                                <div class="text-[13px] font-medium leading-tight text-white md:text-[14px]">
                                    {{ $item['title'] }}
                                </div>
                            @endif
                            @if (!empty($item['year']))
                                <div class="mt-1 text-[11px] uppercase tracking-[0.18em] text-[var(--color-accent-gold)]">
                                    {{ $item['year'] }}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- cinematic gradient (always visible, subtle) --}}
                    <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60"></div>
                </button>
            @endforeach
        @else
            {{-- skeleton state --}}
            @for ($i = 0; $i < $skeletonCount; $i++)
                @php
                    $skelAspects = ['aspect-[4/5]', 'aspect-[4/3]', 'aspect-square', 'aspect-[3/4]', 'aspect-[16/10]', 'aspect-[4/5]'];
                    $aspect = $skelAspects[$i % count($skelAspects)];
                @endphp
                <div class="gallery-skeleton {{ $aspect }} break-inside-avoid w-full overflow-hidden rounded-2xl border border-white/10 bg-[var(--color-surface-navy)]/40">
                    <div class="h-full w-full"></div>
                </div>
            @endfor
        @endif
    </div>
</div>
