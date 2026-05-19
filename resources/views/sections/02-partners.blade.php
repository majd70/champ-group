<section
    id="page-02"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="partners-title"
>
    <div class="mx-auto flex max-w-[1440px] flex-col gap-12 px-6 py-20 md:px-12 md:py-24 lg:py-28">

        {{-- eyebrow --}}
        <div class="flex items-center gap-3">
            <span aria-hidden="true" class="inline-block h-1.5 w-1.5 rounded-full bg-[var(--color-accent-gold)]"></span>
            <x-eyebrow tone="gold">{{ __('sections.trusted_network') }}</x-eyebrow>
        </div>

        {{-- header: title (left) + description (right) --}}
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-[1.55fr_1fr] lg:items-end lg:gap-16">
            <h2 id="partners-title" class="flex flex-col">
                <span class="text-display-xxl text-[var(--color-display-cream)]">{{ __('titles.partner_with') }}</span>
                <span class="-mt-2 flex items-baseline gap-4 md:-mt-4">
                    <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(48px,7vw,120px)] leading-none text-[var(--color-accent-gold)]">{{ __('titles.the') }}</span>
                    <span class="text-display-xxl text-[var(--color-display-cream)]">{{ __('titles.trusted') }}</span>
                </span>
            </h2>

            <div class="flex flex-col gap-5 lg:pb-3">
                <span aria-hidden="true" class="block h-[2px] w-16 bg-[var(--color-accent-gold)]"></span>
                <p class="max-w-[44ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                    {{ __('sections.partners_description') }}
                </p>
                <x-visit-button class="mt-2" />
            </div>
        </div>

        {{-- partner grid: 3 rows × 8 columns of empty logo cards (dashboard-ready) --}}
        @php
            $tiers = [
                [
                    'label' => __('sections.tier_international'),
                    'logos' => [
                        'FC Barcelona',
                        'Metrica Sports',
                        'Barça Innovation Hub',
                        'Real Madrid Football Program',
                        'AC Football Center',
                        'Eskono',
                        'Donosti Cup',
                        'WOSPAC',
                    ],
                ],
                [
                    'label' => __('sections.tier_regional'),
                    'logos' => [
                        'RSM Regional Sports Management',
                        'Nafess.com',
                        'Regional Federation',
                        'Q.SL Qatar Stars League',
                        'Al Ain FC',
                        'Al Nasr SC',
                        'Shabab Al-Ahli Dubai',
                        'Talent',
                    ],
                ],
                [
                    'label' => __('sections.tier_local'),
                    'logos' => [
                        'Pepsi',
                        'UNRWA',
                        'UNDP',
                        'Ooredoo',
                        'Paltel',
                        'Bank of Palestine',
                        'Joul',
                    ],
                    'more_text' => __('sections.more_partners'),
                ],
            ];
        @endphp

        <div class="flex flex-col gap-3">
            @foreach ($tiers as $tier)
                <div class="flex w-full items-center gap-4">
                    {{-- Tier label --}}
                    <div class="flex w-[110px] shrink-0 flex-col gap-1 md:w-[140px]">
                        <x-eyebrow tone="gold">{{ $tier['label'] }}</x-eyebrow>
                        <span class="text-[clamp(20px,2vw,30px)] uppercase leading-none text-white" style="font-family: var(--font-display);">{{ __('sections.partners_word') }}</span>
                    </div>

                    {{-- 8-column card grid --}}
                    <div class="grid min-w-0 flex-1 grid-cols-2 gap-2 sm:grid-cols-4 lg:grid-cols-8 lg:gap-3">
                        @foreach ($tier['logos'] as $logoName)
                            <x-logo-card name="{{ $logoName }}" />
                        @endforeach

                        @if (!empty($tier['more_text']))
                            <div class="flex aspect-[16/9] items-center justify-center px-2 text-center text-[clamp(11px,0.95vw,15px)] leading-[1.3] text-[var(--color-accent-gold)]" style="font-family: var(--font-italic); font-style: italic;">
                                {{ $tier['more_text'] }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- footer --}}
        <x-page-footer index="02" total="12" label="Champions Group · Partnerships" />
    </div>
</section>
