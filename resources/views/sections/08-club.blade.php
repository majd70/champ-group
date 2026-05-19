<section
    id="page-08"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="club-title"
>
    <div class="mx-auto grid max-w-[1440px] grid-cols-1 gap-12 px-6 py-20 md:px-12 md:py-24 lg:grid-cols-2 lg:gap-16 lg:py-28">

        {{-- LEFT COLUMN --}}
        <div class="flex flex-col gap-10">

            {{-- top eyebrow --}}
            <x-eyebrow tone="dim">{{ __('sections.club_eyebrow') }}</x-eyebrow>

            {{-- title row: Champions CLUB + shield, shield pushed to far right --}}
            <div class="flex items-center gap-6">
                <h2 id="club-title" class="flex flex-col">
                    <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(36px,4.5vw,72px)] leading-[0.95] text-[var(--color-accent-gold)]">{{ __('titles.champions') }}</span>
                    <span class="text-[clamp(72px,10vw,170px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">{{ __('titles.club') }}</span>
                </h2>
                <img
                    src="{{ asset('images/page-08/shield.png') }}"
                    alt="Champions Club shield logo"
                    width="320"
                    height="540"
                    class="ms-auto block h-auto w-[clamp(90px,11vw,150px)] select-none lg:me-8"
                    draggable="false"
                >
            </div>

            {{-- description --}}
            <p class="max-w-[55ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                {{ __('sections.club_description') }}
            </p>

            {{-- CTA --}}
            <x-visit-button />

            {{-- horizontal divider --}}
            <hr class="border-0 border-t border-[var(--color-divider)]">

            {{-- bottom: FACILITY SCALE + 24,000 + caption --}}
            <div class="flex items-end gap-6 md:gap-10">
                <span
                    class="text-eyebrow shrink-0 text-[var(--color-text-dim)] whitespace-nowrap"
                    style="writing-mode: vertical-rl; transform: rotate(180deg);"
                >{{ __('sections.facility_scale') }}</span>
                <div class="flex flex-col gap-3">
                    <span class="stat-counter text-[clamp(64px,10vw,160px)] leading-[0.9] tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">24,000</span>
                    <x-eyebrow tone="dim">{{ __('sections.sq_meters_campus') }}</x-eyebrow>
                </div>
            </div>

            {{-- extra info --}}
            <p class="text-[13px] leading-[1.5] text-[var(--color-text-muted)] md:text-[14px]">
                {{ __('sections.club_extra') }}
            </p>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="flex flex-col gap-10 lg:gap-0 lg:border-s lg:border-[var(--color-divider)] lg:ps-12 lg:pt-20">

            {{-- 6-stat grid --}}
            @php
                $stats = [
                    ['number' => '+1ST',   'label' => __('stats.club_1st_label'),  'caption' => null],
                    ['number' => '+3,000', 'label' => __('stats.club_3000_label'),  'caption' => __('stats.club_3000_caption')],
                    ['number' => '+200K',  'label' => __('stats.club_200k_label'),  'caption' => __('stats.club_200k_caption')],
                    ['number' => '+1,220', 'label' => __('stats.club_1220_label'),  'caption' => __('stats.club_1220_caption')],
                    ['number' => '55',     'label' => __('stats.club_55_label'),    'caption' => __('stats.club_55_caption')],
                    ['number' => '+50',    'label' => __('stats.club_50_label'),    'caption' => __('stats.club_50_caption')],
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
                    <x-eyebrow tone="dim">{{ __('sections.partnerships_network') }}</x-eyebrow>
                    @php
                        $clubPartners = [
                            'Pepsi',
                            'UNRWA',
                            'Paltel',
                            'Joul',
                            'Quds Bank',
                            'ATC',
                            'Bank of Palestine',
                            'UNDP',
                            'GIZ',
                            'Oxfam',
                            'ICRC',
                            'Ooredoo',
                        ];
                    @endphp
                    <div class="grid grid-cols-3 gap-2.5 sm:grid-cols-4 md:grid-cols-6">
                        @foreach ($clubPartners as $partner)
                            <x-logo-card name="{{ $partner }}" />
                        @endforeach
                    </div>
                    <span class="self-end text-[clamp(12px,1vw,16px)] leading-[1.3] text-[var(--color-accent-gold)]" style="font-family: var(--font-italic); font-style: italic;">
                        {{ __('sections.more_partners') }}
                    </span>
                </div>

                <x-page-footer index="08" total="12" label="Club · Family Sanctuary" />
            </div>
        </div>
    </div>
</section>
