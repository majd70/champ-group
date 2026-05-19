<section
    id="page-06"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="academy-title"
>
    <div class="mx-auto grid max-w-[1440px] grid-cols-1 gap-12 px-6 py-20 md:px-12 md:py-24 lg:grid-cols-2 lg:gap-16 lg:py-28">

        {{-- LEFT COLUMN --}}
        <div class="flex flex-col gap-10">

            {{-- top eyebrow --}}
            <x-eyebrow tone="dim">Champions Group · Founded 2015</x-eyebrow>

            {{-- title row: Champions ACADEMY + shield, with right padding to keep shield off the divider --}}
            <div class="flex items-center gap-5 md:gap-8 lg:pr-16">
                <h2 id="academy-title" class="flex flex-col">
                    <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(32px,4vw,64px)] leading-[0.95] text-[var(--color-accent-gold)]">Champions</span>
                    <span class="text-[clamp(56px,8vw,130px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">Academy</span>
                </h2>
                <img
                    src="{{ asset('images/page-06/shield.png') }}"
                    alt="Champions Academy shield logo"
                    width="320"
                    height="540"
                    class="block h-auto w-[clamp(80px,10vw,130px)] select-none"
                    draggable="false"
                >
            </div>

            {{-- description --}}
            <p class="max-w-[50ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                Cultivating educated generations to compete internationally across nine sports academies including football, basketball, tennis, swimming, karate, and more.
            </p>

            {{-- CTA --}}
            <x-visit-button />

            {{-- horizontal divider --}}
            <hr class="border-0 border-t border-[var(--color-divider)]">

            {{-- bottom: PLAYERS DEVELOPED + 8,000 + caption --}}
            <div class="flex items-end gap-6 md:gap-10">
                <span
                    class="text-eyebrow shrink-0 text-[var(--color-text-dim)] whitespace-nowrap"
                    style="writing-mode: vertical-rl; transform: rotate(180deg);"
                >Players Developed</span>
                <div class="flex flex-col gap-3">
                    <span class="stat-counter text-[clamp(64px,10vw,160px)] leading-[0.9] tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">8,000</span>
                    <x-eyebrow tone="dim">Players · 5,600 Male · 2,400 Female</x-eyebrow>
                </div>
            </div>

            {{-- extra info --}}
            <p class="text-[13px] leading-[1.5] text-[var(--color-text-muted)] md:text-[14px]">
                Plus 6 basketball cups · 8 table tennis cups · 1 player active in Spain.
            </p>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="flex flex-col gap-10 lg:gap-0 lg:border-l lg:border-[var(--color-divider)] lg:pl-12 lg:pt-20">

            {{-- 6-stat grid (top of column) --}}
            @php
                $stats = [
                    ['number' => '70', 'label' => 'Employees',         'caption' => 'Coaching Staff'],
                    ['number' => '9',  'label' => 'Sports Academies',  'caption' => 'Disciplines'],
                    ['number' => '8',  'label' => 'Football Branches', 'caption' => 'Locations'],
                    ['number' => '8',  'label' => 'Football Cups',     'caption' => 'Won'],
                    ['number' => '10', 'label' => 'Karate Medals',     'caption' => 'Competition'],
                    ['number' => '3',  'label' => 'Pro Players Abroad','caption' => 'International'],
                ];
            @endphp
            <div class="grid grid-cols-3 gap-x-6 gap-y-8 md:gap-x-8 md:gap-y-10">
                @foreach ($stats as $i => $stat)
                    <div class="flex flex-col gap-2 {{ $i >= 3 ? 'md:border-t md:border-[var(--color-divider)] md:pt-8' : '' }}">
                        <span class="stat-counter text-[clamp(36px,4.5vw,72px)] leading-none tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">{{ $stat['number'] }}</span>
                        <span class="text-[12px] leading-[1.4] text-white md:text-[13px]">{{ $stat['label'] }}</span>
                        <x-eyebrow tone="dim">{{ $stat['caption'] }}</x-eyebrow>
                    </div>
                @endforeach
            </div>

            {{-- partnerships + footer pushed to bottom of column to align with 8,000 block on left --}}
            <div class="mt-10 flex flex-col gap-10 lg:mt-auto lg:pt-12">
                <div class="flex flex-col gap-5">
                    <x-eyebrow tone="dim">Partnerships</x-eyebrow>
                    <img
                        src="{{ asset('images/page-06/partners.png') }}"
                        alt="Champions Academy partnerships: Real Madrid Football Program, Donosti Cup, WOSPAC, Nafess.com, RSM Regional Sports Management"
                        width="1260"
                        height="130"
                        class="block w-full select-none"
                        draggable="false"
                    >
                </div>

                <x-page-footer index="06" total="12" label="Academy · 9 Sports" />
            </div>
        </div>
    </div>
</section>
