<section
    id="page-06"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="academy-title"
>
    <div class="mx-auto grid max-w-[1440px] grid-cols-1 gap-12 px-6 py-20 md:px-12 md:py-24 lg:grid-cols-2 lg:gap-16 lg:py-28">

        {{-- LEFT COLUMN --}}
        <div class="flex flex-col gap-10">

            {{-- top eyebrow --}}
            <x-eyebrow tone="dim">{{ __('sections.founded_2015') }}</x-eyebrow>

            {{-- title row: Champions ACADEMY + shield, with right padding to keep shield off the divider --}}
            <div class="flex items-center gap-5 md:gap-8 lg:pe-16">
                <h2 id="academy-title" class="flex flex-col">
                    <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(32px,4vw,64px)] leading-[0.95] text-[var(--color-accent-gold)]">{{ __('titles.champions') }}</span>
                    <span class="text-[clamp(56px,8vw,130px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">{{ __('titles.academy') }}</span>
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
                {{ __('sections.academy_description') }}
            </p>

            {{-- CTA --}}
            <x-visit-button href="https://champions-academies.com/" target="_blank" rel="noopener noreferrer" />

            {{-- horizontal divider --}}
            <hr class="border-0 border-t border-[var(--color-divider)]">

            {{-- bottom: PLAYERS DEVELOPED + 8,000 + caption --}}
            <div class="flex items-end gap-6 md:gap-10">
                <span
                    class="text-eyebrow shrink-0 text-[var(--color-text-dim)] whitespace-nowrap"
                    style="writing-mode: vertical-rl; transform: rotate(180deg);"
                >{{ __('sections.players_developed') }}</span>
                <div class="flex flex-col gap-3">
                    <span class="stat-counter text-[clamp(64px,10vw,160px)] leading-[0.9] tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">8,000</span>
                    <x-eyebrow tone="dim">{{ __('sections.players_breakdown') }}</x-eyebrow>
                </div>
            </div>

            {{-- extra info --}}
            <p class="text-[13px] leading-[1.5] text-[var(--color-text-muted)] md:text-[14px]">
                {{ __('sections.academy_extra') }}
            </p>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="flex flex-col gap-10 lg:gap-0 lg:border-s lg:border-[var(--color-divider)] lg:ps-12 lg:pt-20">

            {{-- 6-stat grid (top of column) --}}
            @php
                $stats = [
                    ['number' => '70', 'label' => __('stats.academy_70_label'), 'caption' => __('stats.academy_70_caption')],
                    ['number' => '9',  'label' => __('stats.academy_9_label'),  'caption' => __('stats.academy_9_caption')],
                    ['number' => '8',  'label' => __('stats.academy_8b_label'), 'caption' => __('stats.academy_8b_caption')],
                    ['number' => '8',  'label' => __('stats.academy_8c_label'), 'caption' => __('stats.academy_8c_caption')],
                    ['number' => '10', 'label' => __('stats.academy_10_label'), 'caption' => __('stats.academy_10_caption')],
                    ['number' => '3',  'label' => __('stats.academy_3_label'),  'caption' => __('stats.academy_3_caption')],
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
                    <x-eyebrow tone="dim">{{ __('sections.partnerships') }}</x-eyebrow>
                    @php
                        $academyPartners = [
                            'Real Madrid Football Program',
                            'Donosti Cup',
                            'WOSPAC',
                            'Nafess.com',
                            'RSM Regional Sports Management',
                        ];
                    @endphp
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-5">
                        @foreach ($academyPartners as $partner)
                            <x-logo-card name="{{ $partner }}" />
                        @endforeach
                    </div>

                    {{-- social — academy has its own TikTok, shares Group main for the rest --}}
                    <div class="mt-2">
                        <x-social-icons
                            :label="__('sections.follow_us')"
                            :links="[
                                ['platform' => 'facebook',  'href' => 'https://www.facebook.com/share/1BdGtciKLt/'],
                                ['platform' => 'instagram', 'href' => 'https://www.instagram.com/champions_ps'],
                                ['platform' => 'tiktok',    'href' => 'https://www.tiktok.com/@champions_academy'],
                            ]"
                        />
                    </div>
                </div>

                <x-page-footer index="06" total="12" :label="__('sections.footer_06')" />
            </div>
        </div>
    </div>
</section>
