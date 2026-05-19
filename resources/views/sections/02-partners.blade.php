<section
    id="page-02"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="partners-title"
>
    <div class="mx-auto flex max-w-[1440px] flex-col gap-12 px-6 py-20 md:px-12 md:py-24 lg:py-28">

        {{-- eyebrow --}}
        <div class="flex items-center gap-3">
            <span aria-hidden="true" class="inline-block h-1.5 w-1.5 rounded-full bg-[var(--color-accent-gold)]"></span>
            <x-eyebrow tone="gold">Champions Group · Trusted Network</x-eyebrow>
        </div>

        {{-- header: title (left) + description (right) --}}
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-[1.55fr_1fr] lg:items-end lg:gap-16">
            <h2 id="partners-title" class="flex flex-col">
                <span class="text-display-xxl text-[var(--color-display-cream)]">Partner with</span>
                <span class="-mt-2 flex items-baseline gap-4 md:-mt-4">
                    <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(48px,7vw,120px)] leading-none text-[var(--color-accent-gold)]">the</span>
                    <span class="text-display-xxl text-[var(--color-display-cream)]">Trusted.</span>
                </span>
            </h2>

            <div class="flex flex-col gap-5 lg:pb-3">
                <span aria-hidden="true" class="block h-[2px] w-16 bg-[var(--color-accent-gold)]"></span>
                <p class="max-w-[44ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                    A decade of partnerships across institutions, federations, brands, and global enterprises — anchoring every division of Champions Group.
                </p>
                <x-visit-button class="mt-2" />
            </div>
        </div>

        {{-- partner grid: cropped as a single image from page-02.png
             (tier labels, 23 logo cells, and "+40 More Partners" text are all
             baked into this crop so the grid renders pixel-identical to source) --}}
        <img
            src="{{ asset('images/page-02/partner-grid.png') }}"
            alt="Champions Group partner network: International, Regional, and Local tiers — 23 logos across FC Barcelona, Metrica Sports, Barça Innovation Hub, Real Madrid Football Program, AC Football Center, Eskono, Donosti Cup, WOSPAC, RSM, Nafess.com, Q.SL, Al Ain FC, Al Nasr SC, Shabab Al-Ahli Dubai, Talent, Pepsi, UNRWA, UNDP, Ooredoo, Paltel, Bank of Palestine, Joul, plus 40 more"
            width="2860"
            height="700"
            class="block w-full select-none"
            draggable="false"
        >

        {{-- footer --}}
        <x-page-footer index="02" total="12" label="Champions Group · Partnerships" />
    </div>
</section>
