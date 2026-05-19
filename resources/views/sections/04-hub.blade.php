<section
    id="page-04"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="hub-title"
>
    <div class="mx-auto flex max-w-[1440px] flex-col gap-10 px-6 py-20 md:px-12 md:py-24 lg:py-28">

        {{-- top eyebrow --}}
        <x-eyebrow tone="dim">Champions Group · Integrated Platform</x-eyebrow>

        {{-- two-column main: text (left) + screenshots + stats + partners (right) --}}
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1.05fr_1fr] lg:gap-16">

            {{-- LEFT COLUMN --}}
            <div class="flex flex-col gap-8">

                {{-- title row: Champions HUB + shield --}}
                <div class="flex items-center gap-8 lg:gap-10">
                    <h2 id="hub-title" class="flex flex-col">
                        <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(40px,5vw,80px)] leading-[0.95] text-[var(--color-accent-gold)]">Champions</span>
                        <span class="text-[clamp(80px,11vw,170px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">HUB</span>
                    </h2>
                    <img
                        src="{{ asset('images/page-04/shield.png') }}"
                        alt="Champions HUB shield logo"
                        width="370"
                        height="465"
                        class="block h-auto w-[clamp(110px,16vw,200px)] select-none"
                        draggable="false"
                    >
                </div>

                {{-- description --}}
                <p class="max-w-[52ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                    A new era of all-in-one sports development — bringing education and technology together from grassroots to professional level, uniting partner courses, certification, performance analysis, and digital services.
                </p>

                {{-- CTA --}}
                <x-visit-button />

                {{-- horizontal rule --}}
                <hr class="border-0 border-t border-[var(--color-divider)]">

                {{-- ALL-IN-ONE block: vertical eyebrow + display --}}
                <div class="flex items-end gap-6 md:gap-10">
                    <span
                        class="text-eyebrow shrink-0 text-[var(--color-accent-gold)] whitespace-nowrap"
                        style="writing-mode: vertical-rl; transform: rotate(180deg);"
                    >Integrated Coverage</span>
                    <div class="flex flex-col gap-2">
                        <span class="text-[clamp(56px,8.5vw,140px)] uppercase leading-[0.9] text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">All-In-One</span>
                        <span class="text-eyebrow text-[var(--color-text-dim)]">Platform · Grassroots to Professional Level</span>
                    </div>
                </div>

                {{-- tagline --}}
                <p class="text-[12.5px] leading-[1.5] text-[var(--color-text-muted)] md:text-[13px]">
                    Performance analysis · managed access · recognized credentials across every aspect of sport.
                </p>
            </div>

            {{-- RIGHT COLUMN: screenshots + stats + partners --}}
            <div class="flex flex-col gap-8">

                {{-- 3 product screenshots (cropped composition) --}}
                <img
                    src="{{ asset('images/page-04/screens.png') }}"
                    alt="Champions Hub platform: homepage, course catalog, and category browser"
                    width="1430"
                    height="730"
                    class="block w-full select-none"
                    draggable="false"
                >

                {{-- 6-stat grid: 2 rows × 3 cols (EDU/CRT/VID | DAT/100%/PRO) --}}
                <div class="grid grid-cols-3 gap-x-4 gap-y-6 border-y border-[var(--color-divider)] py-6 md:gap-x-6 md:py-8">
                    @php
                        $stats = [
                            ['number' => 'EDU',  'label' => 'Education + Tech',       'caption' => 'Integrated'],
                            ['number' => 'CRT',  'label' => 'Partner Certifications', 'caption' => 'Recognized'],
                            ['number' => 'VID',  'label' => 'Video Analysis Hub',     'caption' => 'Performance'],
                            ['number' => 'DAT',  'label' => 'Data Analysis Hubs',     'caption' => 'Insights'],
                            ['number' => '100%', 'label' => 'Digitized Operations',   'caption' => 'End-to-End'],
                            ['number' => 'PRO',  'label' => 'Grassroots → Pro',       'caption' => 'Full Pipeline'],
                        ];
                    @endphp
                    @foreach ($stats as $stat)
                        <div class="flex flex-col gap-2">
                            <span class="stat-counter text-[clamp(28px,3.2vw,52px)] uppercase leading-none text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">{{ $stat['number'] }}</span>
                            <span class="text-[12px] leading-[1.4] text-white md:text-[13px]">{{ $stat['label'] }}</span>
                            <x-eyebrow tone="dim">{{ $stat['caption'] }}</x-eyebrow>
                        </div>
                    @endforeach
                </div>

                {{-- partnerships row: 5 empty logo cards (dashboard-ready) --}}
                <div class="flex flex-col gap-4">
                    <x-eyebrow tone="dim">Partnerships</x-eyebrow>
                    @php
                        $hubPartners = [
                            'Barça Innovation Hub',
                            'AC Football Center',
                            'Eskono',
                            'Metrica Sports',
                            'Nafess.com',
                        ];
                    @endphp
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-5">
                        @foreach ($hubPartners as $partner)
                            <x-logo-card name="{{ $partner }}" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- footer --}}
        <x-page-footer index="04" total="12" label="Champions Group · Hub · Education + Technology" />
    </div>
</section>
