<section
    id="page-04"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="hub-title"
>
    <div class="mx-auto flex max-w-[1440px] flex-col gap-10 px-6 py-20 md:px-12 md:py-24 lg:py-28">

        {{-- top eyebrow --}}
        <x-eyebrow tone="dim">{{ __('sections.integrated_platform') }}</x-eyebrow>

        {{-- two-column main: text (left) + screenshots + stats + partners (right) --}}
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1.05fr_1fr] lg:gap-16">

            {{-- LEFT COLUMN --}}
            <div class="flex flex-col gap-8">

                {{-- title row: Champions HUB + shield --}}
                <div class="flex items-center gap-8 lg:gap-10">
                    <h2 id="hub-title" class="flex flex-col">
                        <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(40px,5vw,80px)] leading-[0.95] text-[var(--color-accent-gold)]">{{ __('titles.champions') }}</span>
                        <span class="text-[clamp(80px,11vw,170px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">{{ __('titles.hub') }}</span>
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
                    {{ __('sections.hub_description') }}
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
                    >{{ __('sections.integrated_coverage') }}</span>
                    <div class="flex flex-col gap-2">
                        <span class="text-[clamp(56px,8.5vw,140px)] uppercase leading-[0.9] text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">{{ __('sections.all_in_one') }}</span>
                        <span class="text-eyebrow text-[var(--color-text-dim)]">{{ __('sections.platform_grassroots') }}</span>
                    </div>
                </div>

                {{-- tagline --}}
                <p class="text-[12.5px] leading-[1.5] text-[var(--color-text-muted)] md:text-[13px]">
                    {{ __('sections.hub_tagline') }}
                </p>
            </div>

            {{-- RIGHT COLUMN: screenshots + stats + partners --}}
            <div class="flex flex-col gap-8">

                {{-- 3 product screenshots — tilted/stacked browser cards with hover lift + lightbox --}}
                @php
                    $screens = [
                        ['src' => 'https://picsum.photos/seed/hub-home/1200/750',     'label' => 'Hub Homepage',  'url' => 'hub.champions.group'],
                        ['src' => 'https://picsum.photos/seed/hub-courses/1200/750',  'label' => 'Course Catalog', 'url' => 'hub.champions.group/courses'],
                        ['src' => 'https://picsum.photos/seed/hub-cats/1200/750',     'label' => 'Categories',     'url' => 'hub.champions.group/categories'],
                    ];
                @endphp
                <div class="hub-screens relative w-full" data-gallery-root="hub-screens">
                    {{-- mobile fallback: simple stacked column. Desktop: absolutely-positioned tilted cards. --}}
                    <div class="flex flex-col gap-4 lg:hidden">
                        @foreach ($screens as $i => $s)
                            <button
                                type="button"
                                data-gallery-item
                                data-src="{{ $s['src'] }}"
                                data-title="Champions Hub · {{ $s['label'] }}"
                                class="group relative w-full overflow-hidden rounded-xl border border-white/10 bg-[var(--color-surface-navy)]/50 transition-all duration-500 hover:border-[var(--color-accent-gold)]/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)]"
                            >
                                <div class="flex items-center gap-2 border-b border-white/10 bg-white/[0.04] px-3 py-2">
                                    <span class="block h-2 w-2 rounded-full bg-[#ff5f56]"></span>
                                    <span class="block h-2 w-2 rounded-full bg-[#ffbd2e]"></span>
                                    <span class="block h-2 w-2 rounded-full bg-[#27c93f]"></span>
                                    <span class="ms-2 truncate text-[10px] tracking-[0.06em] text-white/40">{{ $s['url'] }}</span>
                                </div>
                                <div class="aspect-[16/10] w-full">
                                    <img src="{{ $s['src'] }}" alt="{{ $s['label'] }}" loading="lazy" decoding="async" draggable="false" class="h-full w-full object-cover">
                                </div>
                            </button>
                        @endforeach
                    </div>

                    <div class="relative hidden aspect-[16/11] w-full lg:block">
                        @foreach ($screens as $i => $s)
                            @php
                                // Match original screens.png composition exactly:
                                //  0 = main large card (back-left)
                                //  1 = small dashboard card (front, upper-right)
                                //  2 = small categories card (front, lower-right)
                                $positions = [
                                    ['top' => '6%',  'left' => '0%',    'width' => '72%', 'z' => 10, 'delay' => 0.0],
                                    ['top' => '0%',  'right' => '0%',   'width' => '40%', 'z' => 20, 'delay' => 0.15],
                                    ['top' => '52%', 'right' => '4%',   'width' => '48%', 'z' => 20, 'delay' => 0.3],
                                ];
                                $p = $positions[$i];
                            @endphp
                            <button
                                type="button"
                                data-gallery-item
                                data-src="{{ $s['src'] }}"
                                data-title="Champions Hub · {{ $s['label'] }}"
                                class="hub-screen-card group absolute overflow-hidden rounded-xl border border-white/10 bg-[var(--color-surface-navy)]/70 shadow-[0_25px_60px_-25px_rgba(0,0,0,0.7)] backdrop-blur-md transition-all duration-500 hover:z-30 hover:scale-[1.03] hover:border-[var(--color-accent-gold)]/45 hover:shadow-[0_30px_80px_-20px_rgba(244,184,30,0.35)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)]"
                                style="
                                    top: {{ $p['top'] }};
                                    {{ isset($p['left'])  ? 'left: '  . $p['left']  . ';' : '' }}
                                    {{ isset($p['right']) ? 'right: ' . $p['right'] . ';' : '' }}
                                    width: {{ $p['width'] }};
                                    z-index: {{ $p['z'] }};
                                    transform-origin: center center;
                                    animation: hub-screen-in 0.9s cubic-bezier(0.22,1,0.36,1) both;
                                    animation-delay: {{ $p['delay'] }}s;
                                "
                                aria-label="View screenshot: {{ $s['label'] }}"
                            >
                                <div class="flex items-center gap-2 border-b border-white/10 bg-white/[0.04] px-3 py-2">
                                    <span class="block h-2 w-2 rounded-full bg-[#ff5f56]"></span>
                                    <span class="block h-2 w-2 rounded-full bg-[#ffbd2e]"></span>
                                    <span class="block h-2 w-2 rounded-full bg-[#27c93f]"></span>
                                    <span class="ms-2 truncate text-[10px] tracking-[0.06em] text-white/40">{{ $s['url'] }}</span>
                                </div>
                                <div class="aspect-[16/10] w-full overflow-hidden">
                                    <img
                                        src="{{ $s['src'] }}"
                                        alt="{{ $s['label'] }}"
                                        loading="lazy"
                                        decoding="async"
                                        draggable="false"
                                        class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                    >
                                </div>
                                <span class="pointer-events-none absolute inset-x-3 bottom-3 translate-y-2 rounded-full border border-white/15 bg-black/45 px-3 py-1 text-center text-[10px] uppercase tracking-[0.18em] text-[var(--color-accent-gold)] opacity-0 backdrop-blur-md transition-all duration-500 group-hover:translate-y-0 group-hover:opacity-100">
                                    {{ $s['label'] }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- 6-stat grid: 2 rows × 3 cols (EDU/CRT/VID | DAT/100%/PRO) --}}
                <div class="grid grid-cols-3 gap-x-4 gap-y-6 border-y border-[var(--color-divider)] py-6 md:gap-x-6 md:py-8">
                    @php
                        $stats = [
                            ['number' => 'EDU',  'label' => __('stats.hub_edu_label'), 'caption' => __('stats.hub_edu_caption')],
                            ['number' => 'CRT',  'label' => __('stats.hub_crt_label'), 'caption' => __('stats.hub_crt_caption')],
                            ['number' => 'VID',  'label' => __('stats.hub_vid_label'), 'caption' => __('stats.hub_vid_caption')],
                            ['number' => 'DAT',  'label' => __('stats.hub_dat_label'), 'caption' => __('stats.hub_dat_caption')],
                            ['number' => '100%', 'label' => __('stats.hub_100_label'), 'caption' => __('stats.hub_100_caption')],
                            ['number' => 'PRO',  'label' => __('stats.hub_pro_label'), 'caption' => __('stats.hub_pro_caption')],
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
                    <x-eyebrow tone="dim">{{ __('sections.partnerships') }}</x-eyebrow>
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

                    {{-- social --}}
                    <div class="mt-2">
                        <x-social-icons :label="__('sections.follow_us')" />
                    </div>
                </div>
            </div>
        </div>

        {{-- footer --}}
        <x-page-footer index="04" total="12" :label="__('sections.footer_04')" />
    </div>
</section>
