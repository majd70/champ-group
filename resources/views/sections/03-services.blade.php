<section
    id="page-03"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="services-title"
>
    <div class="mx-auto flex max-w-[1440px] flex-col gap-12 px-6 py-20 md:px-12 md:py-24 lg:py-28">

        {{-- eyebrow --}}
        <x-eyebrow tone="white">{{ __('sections.integrated_portfolio') }}</x-eyebrow>

        {{-- header: title (left) + description (right) --}}
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-[1.3fr_1fr] lg:items-end lg:gap-16">
            <h2 id="services-title" class="flex flex-col">
                <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(36px,4.5vw,72px)] leading-none text-[var(--color-accent-gold)]">{{ __('titles.our') }}</span>
                <span class="text-[clamp(64px,9vw,140px)] uppercase leading-[0.9] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">{{ __('titles.services') }}</span>
            </h2>

            <p class="max-w-[44ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px] lg:pb-4">
                {{ __('sections.services_description') }}
            </p>
        </div>

        {{-- 3x3 service grid: alternating navy/gold checker, positions 2,4,6,8 = gold --}}
        <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2 lg:grid-cols-3">
            <x-service-tile index="01" variant="navy" :title="__('services.title_01')" :description="__('services.desc_01')" />
            <x-service-tile index="02" variant="gold" :title="__('services.title_02')" :description="__('services.desc_02')" />
            <x-service-tile index="03" variant="navy" :title="__('services.title_03')" :description="__('services.desc_03')" />
            <x-service-tile index="04" variant="gold" :title="__('services.title_04')" :description="__('services.desc_04')" />
            <x-service-tile index="05" variant="navy" :title="__('services.title_05')" :description="__('services.desc_05')" />
            <x-service-tile index="06" variant="gold" :title="__('services.title_06')" :description="__('services.desc_06')" />
            <x-service-tile index="07" variant="navy" :title="__('services.title_07')" :description="__('services.desc_07')" />
            <x-service-tile index="08" variant="gold" :title="__('services.title_08')" :description="__('services.desc_08')" />
            <x-service-tile index="09" variant="navy" :title="__('services.title_09')" :description="__('services.desc_09')" />
        </div>

        {{-- footer --}}
        <x-page-footer index="03" total="12" :label="__('sections.footer_03')" />
    </div>
</section>
