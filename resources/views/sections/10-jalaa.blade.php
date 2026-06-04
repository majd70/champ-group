<section
    id="page-10"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="jalaa-title"
>
    <div class="mx-auto grid max-w-[1440px] grid-cols-1 gap-12 px-6 py-20 md:px-12 md:py-24 lg:grid-cols-2 lg:gap-16 lg:py-28">

        {{-- LEFT COLUMN --}}
        <div class="flex flex-col gap-10">

            {{-- top eyebrow --}}
            <x-eyebrow tone="dim">{{ __('sections.jalaa_eyebrow') }}</x-eyebrow>

            {{-- title: "Al" sits above, then JALAA' + shield share the same row so they align --}}
            <h2 id="jalaa-title" class="flex flex-col gap-1">
                <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(36px,4.5vw,72px)] leading-[0.95] text-[var(--color-accent-gold)]">{{ __('titles.al') }}</span>
                <div class="flex items-center gap-12 md:gap-20">
                    <span class="text-[clamp(64px,9vw,150px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">{{ __('titles.jalaa') }}</span>
                    <img
                        src="{{ asset('images/page-10/shield.png') }}"
                        alt="Al Jalaa shield logo — orange phoenix emblem"
                        width="420"
                        height="460"
                        class="block h-auto w-[clamp(100px,12vw,170px)] select-none"
                        draggable="false"
                    >
                </div>
            </h2>

            {{-- description --}}
            <p class="max-w-[55ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                {{ __('sections.jalaa_description') }}
            </p>

            {{-- horizontal divider --}}
            <hr class="border-0 border-t border-[var(--color-divider)]">

            {{-- founded year stacked 19 / 92 --}}
            <div class="flex items-end gap-6 md:gap-10">
                <span
                    class="text-eyebrow shrink-0 text-[var(--color-text-dim)] whitespace-nowrap"
                    style="writing-mode: vertical-rl; transform: rotate(180deg);"
                >{{ __('sections.founded') }}</span>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col leading-[0.85]">
                        <span class="stat-counter text-[clamp(64px,10vw,160px)] tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">19</span>
                        <span class="stat-counter text-[clamp(64px,10vw,160px)] tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">92</span>
                    </div>
                    <x-eyebrow tone="dim">{{ __('sections.year_founded_div') }}</x-eyebrow>
                </div>
            </div>

            {{-- ambitions --}}
            <p class="text-[13px] leading-[1.5] text-[var(--color-text-muted)] md:text-[14px]">
                <span class="text-[var(--color-display-cream)]">{{ __('sections.ambitions') }}</span> {{ __('sections.ambitions_text') }}
            </p>

            {{-- CTA --}}
            <x-visit-button />
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="flex flex-col gap-10 lg:gap-0 lg:border-s lg:border-[var(--color-divider)] lg:ps-12">

            {{-- 2x2 photo mosaic — placeholder images (swap with real cropped photos later) --}}
            @php
                $tiles = [
                    ['src' => 'https://picsum.photos/seed/jalaa-founding/900/700',  'year' => '1992',     'label' => 'Founding Squad'],
                    ['src' => 'https://picsum.photos/seed/jalaa-acquired/900/700',  'year' => '2022',     'label' => 'Acquisition Era'],
                    ['src' => 'https://picsum.photos/seed/jalaa-heritage/900/700',  'year' => 'Heritage', 'label' => 'Generations of Jalaa'],
                    ['src' => 'https://picsum.photos/seed/jalaa-today/900/700',     'year' => '2024',     'label' => 'Today · Active Squad'],
                ];
            @endphp
            <div class="jalaa-mosaic" data-gallery-root="jalaa-photos">
                <div class="grid grid-cols-2 gap-2 md:gap-3">
                    @foreach ($tiles as $i => $tile)
                        <button
                            type="button"
                            data-gallery-item
                            data-index="{{ $i }}"
                            data-src="{{ $tile['src'] }}"
                            data-title="Al Jalaa · {{ $tile['label'] }}"
                            data-year="{{ $tile['year'] }}"
                            class="jalaa-tile group relative aspect-[4/3] overflow-hidden rounded-xl border border-white/10 transition-all duration-500 hover:border-[var(--color-accent-gold)]/45 hover:shadow-[0_18px_50px_-15px_rgba(244,184,30,0.35)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)]"
                            style="animation-delay: {{ $i * 0.12 }}s;"
                            aria-label="View photo: {{ $tile['label'] }}"
                        >
                            <img
                                src="{{ $tile['src'] }}"
                                alt="{{ $tile['label'] }}"
                                loading="lazy"
                                decoding="async"
                                draggable="false"
                                class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.06]"
                            >

                            {{-- bottom gradient + year badge on hover --}}
                            <span aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/55 via-transparent to-transparent"></span>
                            <span class="pointer-events-none absolute inset-x-3 bottom-3 flex translate-y-2 items-center justify-between opacity-0 transition-all duration-500 group-hover:translate-y-0 group-hover:opacity-100">
                                <span class="rounded-full border border-white/20 bg-black/40 px-2.5 py-1 text-[10px] uppercase tracking-[0.2em] text-[var(--color-accent-gold)] backdrop-blur-md">
                                    {{ $tile['year'] }}
                                </span>
                                <span class="text-[11px] font-medium text-white/90">{{ $tile['label'] }}</span>
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- 6-stat grid + footer pushed to bottom of column --}}
            @php
                $stats = [
                    ['number' => '9,000', 'label' => __('stats.jalaa_9000_label'), 'caption' => __('stats.jalaa_9000_caption')],
                    ['number' => '9',     'label' => __('stats.jalaa_9_label'),    'caption' => __('stats.jalaa_9_caption')],
                    ['number' => '40',    'label' => __('stats.jalaa_40_label'),   'caption' => __('stats.jalaa_40_caption')],
                    ['number' => '34',    'label' => __('stats.jalaa_34_label'),   'caption' => __('stats.jalaa_34_caption')],
                    ['number' => '50',    'label' => __('stats.jalaa_50_label'),   'caption' => __('stats.jalaa_50_caption')],
                    ['number' => '1992',  'label' => __('stats.jalaa_1992_label'), 'caption' => __('stats.jalaa_1992_caption')],
                ];
            @endphp
            <div class="mt-10 flex flex-col gap-10 lg:mt-auto lg:pt-12">
                <div class="grid grid-cols-3 gap-x-4 gap-y-6 md:gap-x-6 md:gap-y-8">
                    @foreach ($stats as $i => $stat)
                        <div class="flex flex-col gap-2 {{ $i >= 3 ? 'md:border-t md:border-[var(--color-divider)] md:pt-6' : '' }}">
                            <span class="stat-counter text-[clamp(30px,3.8vw,60px)] leading-none tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">{{ $stat['number'] }}</span>
                            <span class="text-[12px] leading-[1.4] text-white md:text-[13px]">{{ $stat['label'] }}</span>
                            <x-eyebrow tone="dim">{{ $stat['caption'] }}</x-eyebrow>
                        </div>
                    @endforeach
                </div>

                {{-- social --}}
                <x-social-icons :label="__('sections.follow_us')" />

                <x-page-footer index="10" total="12" :label="__('sections.footer_10')" />
            </div>
        </div>
    </div>
</section>
