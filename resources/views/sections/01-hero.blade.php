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

        {{-- main split: left content + right olive panel --}}
        <div class="relative mt-10 grid flex-1 grid-cols-1 gap-10 lg:mt-0 lg:grid-cols-[1.55fr_1fr] lg:gap-0">

            {{-- LEFT: headline, paragraph, stats --}}
            <div class="flex flex-col justify-between gap-12 lg:pe-12 lg:py-10">

                {{-- headline --}}
                <h1 id="hero-title" class="flex flex-col">
                    <span class="js-hero-title-line text-display-xxl text-[var(--color-display-cream)]">{{ __('titles.champions') }}</span>
                    <span class="js-hero-title-line text-display-xxl -mt-2 text-[var(--color-accent-gold)] md:-mt-4">{{ __('titles.group') }}</span>
                </h1>

                {{-- body paragraph + CTA --}}
                <div class="flex flex-col gap-6">
                    <p class="js-hero-desc max-w-[52ch] text-[14px] leading-[1.75] text-[var(--color-text-muted)] md:text-[15px]">
                        {{ __('sections.hero_description') }}
                    </p>
                    <x-visit-button />
                </div>

                {{-- stats row --}}
                <dl class="grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-3 md:grid-cols-5 md:gap-x-8">
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
            </div>

            {{-- RIGHT: shield + vertical rail. Negative top/bottom margins on lg
                 extend the olive bg vertically without changing horizontal width --}}
            <div class="relative flex items-center justify-center bg-[var(--color-panel-olive)] py-16 lg:-my-[160px] lg:py-[160px]">

                {{-- faint concentric ring guides, gold tinted --}}
                <div
                    aria-hidden="true"
                    class="pointer-events-none absolute inset-0 opacity-[0.18]"
                    style="background-image:
                        radial-gradient(circle at 50% 50%, transparent 0, transparent 26%, rgba(244,184,30,0.45) 26.3%, transparent 27%),
                        radial-gradient(circle at 50% 50%, transparent 0, transparent 38%, rgba(244,184,30,0.35) 38.3%, transparent 39%),
                        radial-gradient(circle at 50% 50%, transparent 0, transparent 52%, rgba(244,184,30,0.25) 52.3%, transparent 53%);"
                ></div>

                {{-- shield (cropped from page-01.png; bg matches panel so it tiles seamlessly) --}}
                <img
                    src="{{ asset('images/page-01/shield.png') }}"
                    alt="Champions Group shield logo"
                    width="680"
                    height="920"
                    class="js-hero-shield relative z-10 h-auto w-[clamp(220px,30vw,420px)] select-none"
                    draggable="false"
                >

                {{-- vertical caps rail at right edge --}}
                <div
                    aria-hidden="true"
                    class="js-hero-rail absolute end-2 top-1/2 hidden -translate-y-1/2 lg:block"
                >
                    <span
                        class="text-eyebrow text-[var(--color-accent-gold)]/80 whitespace-nowrap"
                        style="writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: 0.55em;"
                    >Club · Academy · Business · Hub · Egytalhub · Jalaa'</span>
                </div>
            </div>
        </div>

        {{-- footer strip --}}
        <div class="mt-10">
            <x-page-footer index="01" total="12" label="Champions Group · Cover" />
        </div>
    </div>
</section>
