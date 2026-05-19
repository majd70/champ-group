<section
    id="page-08"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="club-title"
>
    <div class="mx-auto grid max-w-[1440px] grid-cols-1 gap-12 px-6 py-20 md:px-12 md:py-24 lg:grid-cols-2 lg:gap-16 lg:py-28">

        {{-- LEFT COLUMN --}}
        <div class="flex flex-col gap-10">

            {{-- top eyebrow --}}
            <x-eyebrow tone="dim">Champions Group · 2018 · 2023</x-eyebrow>

            {{-- title row: Champions CLUB + shield, shield pushed to far right --}}
            <div class="flex items-center gap-6">
                <h2 id="club-title" class="flex flex-col">
                    <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(36px,4.5vw,72px)] leading-[0.95] text-[var(--color-accent-gold)]">Champions</span>
                    <span class="text-[clamp(72px,10vw,170px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">Club</span>
                </h2>
                <img
                    src="{{ asset('images/page-08/shield.png') }}"
                    alt="Champions Club shield logo"
                    width="320"
                    height="540"
                    class="ml-auto block h-auto w-[clamp(90px,11vw,150px)] select-none lg:mr-8"
                    draggable="false"
                >
            </div>

            {{-- description --}}
            <p class="max-w-[55ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                A 24,000 m² sanctuary founded in 2018 as the first family club of its kind in Palestine — offering diverse activities spanning sports, social, and cultural engagement, with fully digitized operations. The club was completely destroyed in the October 2023 war.
            </p>

            {{-- horizontal divider --}}
            <hr class="border-0 border-t border-[var(--color-divider)]">

            {{-- bottom: FACILITY SCALE + 24,000 + caption --}}
            <div class="flex items-end gap-6 md:gap-10">
                <span
                    class="text-eyebrow shrink-0 text-[var(--color-text-dim)] whitespace-nowrap"
                    style="writing-mode: vertical-rl; transform: rotate(180deg);"
                >Facility Scale</span>
                <div class="flex flex-col gap-3">
                    <span class="stat-counter text-[clamp(64px,10vw,160px)] leading-[0.9] tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">24,000</span>
                    <x-eyebrow tone="dim">Square Meters · Multi-Purpose Family Campus</x-eyebrow>
                </div>
            </div>

            {{-- extra info --}}
            <p class="text-[13px] leading-[1.5] text-[var(--color-text-muted)] md:text-[14px]">
                Plus +20 commercial exhibitions hosted on-site annually.
            </p>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="flex flex-col gap-10 lg:gap-0 lg:border-l lg:border-[var(--color-divider)] lg:pl-12 lg:pt-20">

            {{-- 6-stat grid --}}
            @php
                $stats = [
                    ['number' => '+1ST',    'label' => 'Family Club in Palestine', 'caption' => null],
                    ['number' => '+3,000',  'label' => 'Members',                  'caption' => 'Active'],
                    ['number' => '+200K',   'label' => 'Annual Visitors',          'caption' => 'Per Year'],
                    ['number' => '+1,220',  'label' => 'Activities',               'caption' => 'Sports + Cultural'],
                    ['number' => '55',      'label' => 'Staff',                    'caption' => 'On-Site'],
                    ['number' => '+50',     'label' => 'Community Initiatives',    'caption' => 'Outreach'],
                ];
            @endphp
            <div class="grid grid-cols-3 gap-x-4 gap-y-6 md:gap-x-6 md:gap-y-8">
                @foreach ($stats as $i => $stat)
                    <div class="flex flex-col gap-3 {{ $i >= 3 ? 'md:border-t md:border-[var(--color-divider)] md:pt-6' : '' }}">
                        <span class="stat-counter text-[clamp(30px,3.8vw,60px)] leading-none tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">{{ $stat['number'] }}</span>
                        <span class="text-[12px] leading-[1.4] text-white md:text-[13px]">{{ $stat['label'] }}</span>
                        @if ($stat['caption'])
                            <x-eyebrow tone="dim">{{ $stat['caption'] }}</x-eyebrow>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- partnerships + footer pushed to bottom --}}
            <div class="mt-10 flex flex-col gap-10 lg:mt-auto lg:pt-12">
                <div class="flex flex-col gap-5">
                    <x-eyebrow tone="dim">Partnerships · 40+ Network</x-eyebrow>
                    <img
                        src="{{ asset('images/page-08/partners.png') }}"
                        alt="Champions Club 40+ partner network: Pepsi, UNRWA, Paltel, Joul, Quds Bank, ATC, Bank of Palestine, UNDP, GIZ, Oxfam, ICRC, Ooredoo, and more"
                        width="1295"
                        height="320"
                        class="block w-full select-none"
                        draggable="false"
                    >
                </div>

                <x-page-footer index="08" total="12" label="Club · Family Sanctuary" />
            </div>
        </div>
    </div>
</section>
