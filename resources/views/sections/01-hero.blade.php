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

        {{-- main content --}}
        <div class="relative mt-10 flex flex-1 flex-col lg:mt-0">

            {{-- headline, paragraph, stats --}}
            <div class="flex flex-col justify-between gap-12 lg:py-10">

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

        </div>

        {{-- footer strip --}}
        <div class="mt-10">
            <x-page-footer index="01" total="12" label="Champions Group · Cover" />
        </div>
    </div>
</section>
