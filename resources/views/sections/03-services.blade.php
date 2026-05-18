<section
    id="page-03"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="services-title"
>
    <div class="mx-auto flex max-w-[1440px] flex-col gap-12 px-6 py-20 md:px-12 md:py-24 lg:py-28">

        {{-- eyebrow --}}
        <x-eyebrow tone="white">Champions Group · Integrated Portfolio</x-eyebrow>

        {{-- header: title (left) + description (right) --}}
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-[1.3fr_1fr] lg:items-end lg:gap-16">
            <h2 id="services-title" class="flex flex-col">
                <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(36px,4.5vw,72px)] leading-none text-[var(--color-accent-gold)]">Our</span>
                <span class="text-[clamp(64px,9vw,140px)] uppercase leading-[0.9] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">Services</span>
            </h2>

            <p class="max-w-[44ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px] lg:pb-4">
                An integrated portfolio across the sports ecosystem — education, technology, consulting, events, and talent.
            </p>
        </div>

        {{-- 3x3 service grid: alternating navy/gold checker, positions 2,4,6,8 = gold --}}
        <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2 lg:grid-cols-3">
            <x-service-tile index="01" variant="navy" title="Education & Tech"
                description="Localization, curriculum & interactive learning." />
            <x-service-tile index="02" variant="gold" title="Building Communities"
                description="We build sports communities where connection, belonging, and family spirit last for generations." />
            <x-service-tile index="03" variant="navy" title="Grassroots Development"
                description="Scout, train & graduate young athletes across 9 sports." />
            <x-service-tile index="04" variant="gold" title="LMS Platform"
                description="AI-powered learning, gamification & white-label." />
            <x-service-tile index="05" variant="navy" title="Performance Analysis"
                description="Video & data analysis for players and teams." />
            <x-service-tile index="06" variant="gold" title="Consulting"
                description="Strategy, governance & academy setup." />
            <x-service-tile index="07" variant="navy" title="Custom Solutions"
                description="Custom systems, dashboards & AI integration." />
            <x-service-tile index="08" variant="gold" title="Events & B2B"
                description="Tournaments, sponsorships & corporate events." />
            <x-service-tile index="09" variant="navy" title="Long-Distance Services"
                description="Staff augmentation & project-based development (non-sports)." />
        </div>

        {{-- footer --}}
        <x-page-footer index="03" total="12" label="Champions Group · Our Services" />
    </div>
</section>
