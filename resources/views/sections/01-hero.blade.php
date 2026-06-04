<section
    id="page-01"
    class="relative w-full overflow-hidden bg-[var(--color-bg-navy)]"
    aria-labelledby="hero-title"
>
    <div class="relative mx-auto flex min-h-screen max-w-[1440px] flex-col px-6 py-10 md:px-12 md:py-12 lg:py-14">

        {{-- top eyebrow --}}
        <div class="js-hero-eyebrow flex items-center gap-3 pb-1">
            <span aria-hidden="true" class="inline-block h-1.5 w-1.5 rounded-full bg-[var(--color-accent-gold)]"></span>
            <x-eyebrow tone="white">{{ __('sections.hero_eyebrow') }}</x-eyebrow>
            <span aria-hidden="true" class="text-eyebrow text-[var(--color-text-dim)]">·</span>
            <x-eyebrow tone="dim">{{ __('sections.hero_est') }}</x-eyebrow>
            <span aria-hidden="true" class="text-eyebrow text-[var(--color-text-dim)]">·</span>
            <x-eyebrow tone="dim">{{ __('sections.hero_mena') }}</x-eyebrow>
        </div>

        {{-- visually hidden h1 retained for SEO / a11y --}}
        <h1 id="hero-title" class="sr-only">{{ __('titles.champions') }} {{ __('titles.group') }}</h1>

        {{-- full-width premium slider — ken-burns, glassmorphism arrows, counter, caption, gold inset --}}
        @php
            $heroSlides = [
                ['src' => 'https://picsum.photos/seed/hero-academy/1600/900',  'alt' => 'Champions Academy training',   'eyebrow' => 'Academy', 'title' => 'Where Champions Are Built'],
                ['src' => 'https://picsum.photos/seed/hero-stadium/1600/900',  'alt' => 'Stadium night atmosphere',     'eyebrow' => 'Venue',   'title' => 'Stadium Nights'],
                ['src' => 'https://picsum.photos/seed/hero-trophy/1600/900',   'alt' => 'Trophy ceremony',              'eyebrow' => 'Honors',  'title' => 'Trophy Moments'],
                ['src' => 'https://picsum.photos/seed/hero-team/1600/900',     'alt' => 'Team celebration',             'eyebrow' => 'Team',    'title' => 'United in Victory'],
                ['src' => 'https://picsum.photos/seed/hero-coach/1600/900',    'alt' => 'Coaching session',             'eyebrow' => 'Coaching','title' => 'Excellence in Practice'],
            ];
        @endphp
        <div
            x-data="{
                current: 0,
                total: {{ count($heroSlides) }},
                timer: null,
                tick: 0,
                go(i) { this.current = ((i % this.total) + this.total) % this.total; this.tick++; },
                next() { this.go(this.current + 1); },
                prev() { this.go(this.current - 1); },
                start() { this.stop(); this.timer = setInterval(() => this.next(), 5500); },
                stop() { if (this.timer) { clearInterval(this.timer); this.timer = null; } },
            }"
            x-init="start()"
            @mouseenter="stop()"
            @mouseleave="start()"
            @keydown.window.arrow-right="next(); start()"
            @keydown.window.arrow-left="prev(); start()"
            class="hero-slider relative mt-8 w-full flex-1 overflow-hidden rounded-2xl border border-white/10 shadow-[0_30px_80px_-25px_rgba(0,0,0,0.8)] aspect-[4/5] sm:aspect-[16/9] lg:aspect-auto lg:min-h-[560px]"
            role="region"
            aria-roledescription="carousel"
            aria-label="Champions Group highlights"
            tabindex="0"
        >
            {{-- slides --}}
            @foreach ($heroSlides as $i => $s)
                <div
                    x-bind:class="current === {{ $i }} ? 'opacity-100 z-0 is-active' : 'opacity-0 z-0'"
                    class="hero-slide absolute inset-0 transition-opacity duration-[1400ms] ease-in-out"
                >
                    <img
                        src="{{ $s['src'] }}"
                        alt="{{ $s['alt'] }}"
                        loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                        decoding="async"
                        draggable="false"
                        class="hero-slide__img h-full w-full object-cover"
                    >
                </div>
            @endforeach

            {{-- cinematic gradients (sides + bottom) for caption legibility --}}
            <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/70 via-black/15 to-black/30"></div>
            <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-r from-black/55 via-transparent to-transparent"></div>

            {{-- inset gold hairline frame --}}
            <div aria-hidden="true" class="pointer-events-none absolute inset-3 rounded-xl border border-[var(--color-accent-gold)]/15 md:inset-4"></div>

            {{-- ambient gold particles --}}
            <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                @for ($p = 0; $p < 8; $p++)
                    <span class="showcase-particle" style="--p-delay: {{ $p * 1.1 }}s; --p-x: {{ (15 + $p * 11) % 100 }}%; --p-size: {{ 2 + ($p % 3) }}px;"></span>
                @endfor
            </div>

            {{-- TOP-START: counter --}}
            <div class="absolute start-5 top-5 z-10 inline-flex items-center gap-2 rounded-full border border-white/15 bg-black/35 px-3 py-1.5 backdrop-blur-md md:start-8 md:top-8">
                <span class="text-[11px] font-medium tabular-nums tracking-[0.2em] text-[var(--color-accent-gold)]" x-text="String(current + 1).padStart(2, '0')"></span>
                <span aria-hidden="true" class="h-px w-3 bg-white/30"></span>
                <span class="text-[11px] font-medium tabular-nums tracking-[0.2em] text-white/55">{{ str_pad((string) count($heroSlides), 2, '0', STR_PAD_LEFT) }}</span>
            </div>

            {{-- TOP-END: live slide eyebrow tag --}}
            <div class="absolute end-5 top-5 z-10 inline-flex items-center gap-2 rounded-full border border-[var(--color-accent-gold)]/35 bg-[var(--color-accent-gold)]/10 px-3 py-1.5 backdrop-blur-md md:end-8 md:top-8">
                <span aria-hidden="true" class="inline-block h-1.5 w-1.5 rounded-full bg-[var(--color-accent-gold)]"></span>
                <span class="text-[10px] font-medium uppercase tracking-[0.24em] text-[var(--color-accent-gold)]">
                    @foreach ($heroSlides as $i => $s)
                        <span x-show="current === {{ $i }}">{{ $s['eyebrow'] }}</span>
                    @endforeach
                </span>
            </div>

            {{-- SIDES: prev / next arrows --}}
            <button
                type="button"
                @click="prev(); start()"
                aria-label="Previous slide"
                class="hero-arrow group absolute start-4 top-1/2 z-10 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-black/30 text-white backdrop-blur-md transition-all duration-300 hover:border-[var(--color-accent-gold)]/55 hover:bg-[var(--color-accent-gold)]/15 hover:text-[var(--color-accent-gold)] md:start-6 md:h-12 md:w-12"
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="rtl:rotate-180" aria-hidden="true">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button
                type="button"
                @click="next(); start()"
                aria-label="Next slide"
                class="hero-arrow group absolute end-4 top-1/2 z-10 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-black/30 text-white backdrop-blur-md transition-all duration-300 hover:border-[var(--color-accent-gold)]/55 hover:bg-[var(--color-accent-gold)]/15 hover:text-[var(--color-accent-gold)] md:end-6 md:h-12 md:w-12"
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="rtl:rotate-180" aria-hidden="true">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>

            {{-- BOTTOM-START: caption (title) + CTA --}}
            <div class="absolute bottom-6 start-5 z-10 max-w-[78%] md:bottom-10 md:start-10 lg:max-w-[60%]">
                <div class="overflow-hidden">
                    @foreach ($heroSlides as $i => $s)
                        <h2
                            x-show="current === {{ $i }}"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="text-[clamp(22px,3vw,42px)] leading-[1.05] text-[var(--color-display-cream)]"
                            style="font-family: var(--font-display);"
                        >{{ $s['title'] }}</h2>
                    @endforeach
                </div>
                <div class="mt-5">
                    <x-visit-button />
                </div>
            </div>

            {{-- BOTTOM-END: segmented progress dots --}}
            <div class="absolute bottom-8 end-5 z-10 flex items-center gap-1.5 md:bottom-12 md:end-10">
                @foreach ($heroSlides as $i => $s)
                    <button
                        type="button"
                        @click="go({{ $i }}); start()"
                        x-bind:class="current === {{ $i }} ? 'h-[3px] w-10 bg-[var(--color-accent-gold)]' : (current > {{ $i }} ? 'h-[3px] w-6 bg-[var(--color-accent-gold)]/55' : 'h-[3px] w-6 bg-white/25 hover:bg-white/45')"
                        class="rounded-full transition-all duration-500"
                        aria-label="Go to slide {{ $i + 1 }}"
                    ></button>
                @endforeach
            </div>
        </div>

        {{-- stats full-width below the slider --}}
        <dl class="mt-10 grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-3 md:grid-cols-5 md:gap-x-8">
            <div>
                <dt class="sr-only">{{ __('stats.hero_building_mena') }}</dt>
                <dd><x-stat-block class="js-hero-stat" number="12" :unit="__('stats.hero_yr')" :label="__('stats.hero_building_mena')" /></dd>
            </div>
            <div>
                <dt class="sr-only">{{ __('stats.hero_strategic_partners') }}</dt>
                <dd><x-stat-block class="js-hero-stat" number="50+" :label="__('stats.hero_strategic_partners')" /></dd>
            </div>
            <div>
                <dt class="sr-only">{{ __('stats.hero_group_arms') }}</dt>
                <dd><x-stat-block class="js-hero-stat" number="6" :label="__('stats.hero_group_arms')" /></dd>
            </div>
            <div>
                <dt class="sr-only">{{ __('stats.hero_registered_countries') }}</dt>
                <dd><x-stat-block class="js-hero-stat" number="5" :label="__('stats.hero_registered_countries')" /></dd>
            </div>
            <div>
                <dt class="sr-only">{{ __('stats.hero_team_members') }}</dt>
                <dd><x-stat-block class="js-hero-stat" number="180" :label="__('stats.hero_team_members')" /></dd>
            </div>
        </dl>

        {{-- footer strip --}}
        <div class="mt-10">
            <x-page-footer index="01" total="12" :label="__('sections.footer_01')" />
        </div>
    </div>
</section>
