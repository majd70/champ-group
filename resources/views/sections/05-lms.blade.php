<section
    id="page-05"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="lms-title"
>
    <div class="mx-auto flex max-w-[1440px] flex-col gap-12 px-6 py-20 md:px-12 md:py-24 lg:py-28">

        {{-- top eyebrow --}}
        <x-eyebrow tone="gold">{{ __('sections.learning_platform') }}</x-eyebrow>

        {{-- top zone: title (left) + laptops (right) --}}
        <div class="grid grid-cols-1 items-end gap-10 lg:grid-cols-[1fr_2.3fr] lg:gap-8">
            <h2 id="lms-title" class="flex flex-col">
                <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(40px,5.5vw,90px)] leading-[0.95] text-[var(--color-accent-gold)]">{{ __('titles.champions') }}</span>
                <span class="text-[clamp(80px,12vw,180px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">{{ __('titles.lms') }}</span>
            </h2>

            @php
                $lmsScreens = [
                    ['src' => 'https://picsum.photos/seed/lms-welcome/1200/750',   'label' => 'Welcome Dashboard', 'url' => 'lms.champions.group'],
                    ['src' => 'https://picsum.photos/seed/lms-video/1200/750',     'label' => 'Course Player',     'url' => 'lms.champions.group/course'],
                    ['src' => 'https://picsum.photos/seed/lms-community/1200/750', 'label' => 'Community',         'url' => 'lms.champions.group/community'],
                ];
            @endphp

            <div class="lms-screens w-full" data-gallery-root="lms-screens">

                {{-- Mobile fallback: stacked column --}}
                <div class="flex flex-col gap-4 lg:hidden">
                    @foreach ($lmsScreens as $s)
                        <button
                            type="button"
                            data-gallery-item
                            data-src="{{ $s['src'] }}"
                            data-title="Champions LMS · {{ $s['label'] }}"
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

                {{-- Desktop composition: left card · center monitor · right card, with 3D perspective tilts --}}
                <div class="relative hidden aspect-[3/1] w-full lg:block" style="perspective: 1600px;">

                    {{-- LEFT card (Welcome) — tilted right with rotateY --}}
                    <button
                        type="button"
                        data-gallery-item
                        data-src="{{ $lmsScreens[0]['src'] }}"
                        data-title="Champions LMS · {{ $lmsScreens[0]['label'] }}"
                        class="lms-card group absolute overflow-hidden rounded-lg border border-white/10 bg-[var(--color-surface-navy)]/70 shadow-[0_25px_60px_-25px_rgba(0,0,0,0.7)] backdrop-blur-md transition-all duration-500 hover:z-30 hover:shadow-[0_30px_80px_-20px_rgba(244,184,30,0.35)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)]"
                        style="
                            left: 2%;
                            top: 18%;
                            width: 28%;
                            z-index: 10;
                            transform: rotateY(20deg);
                            transform-origin: right center;
                            animation: hub-screen-in 0.9s cubic-bezier(0.22,1,0.36,1) both;
                            animation-delay: 0.0s;
                        "
                        aria-label="View screenshot: {{ $lmsScreens[0]['label'] }}"
                    >
                        <div class="flex items-center gap-1.5 border-b border-white/10 bg-white/[0.04] px-2.5 py-1.5">
                            <span class="block h-1.5 w-1.5 rounded-full bg-[#ff5f56]"></span>
                            <span class="block h-1.5 w-1.5 rounded-full bg-[#ffbd2e]"></span>
                            <span class="block h-1.5 w-1.5 rounded-full bg-[#27c93f]"></span>
                        </div>
                        <div class="aspect-[16/10] w-full overflow-hidden">
                            <img src="{{ $lmsScreens[0]['src'] }}" alt="{{ $lmsScreens[0]['label'] }}" loading="lazy" decoding="async" draggable="false" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        </div>
                    </button>

                    {{-- RIGHT card (Community) — tilted left with rotateY --}}
                    <button
                        type="button"
                        data-gallery-item
                        data-src="{{ $lmsScreens[2]['src'] }}"
                        data-title="Champions LMS · {{ $lmsScreens[2]['label'] }}"
                        class="lms-card group absolute overflow-hidden rounded-lg border border-white/10 bg-[var(--color-surface-navy)]/70 shadow-[0_25px_60px_-25px_rgba(0,0,0,0.7)] backdrop-blur-md transition-all duration-500 hover:z-30 hover:shadow-[0_30px_80px_-20px_rgba(244,184,30,0.35)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)]"
                        style="
                            right: 2%;
                            top: 18%;
                            width: 28%;
                            z-index: 10;
                            transform: rotateY(-20deg);
                            transform-origin: left center;
                            animation: hub-screen-in 0.9s cubic-bezier(0.22,1,0.36,1) both;
                            animation-delay: 0.3s;
                        "
                        aria-label="View screenshot: {{ $lmsScreens[2]['label'] }}"
                    >
                        <div class="flex items-center gap-1.5 border-b border-white/10 bg-white/[0.04] px-2.5 py-1.5">
                            <span class="block h-1.5 w-1.5 rounded-full bg-[#ff5f56]"></span>
                            <span class="block h-1.5 w-1.5 rounded-full bg-[#ffbd2e]"></span>
                            <span class="block h-1.5 w-1.5 rounded-full bg-[#27c93f]"></span>
                        </div>
                        <div class="aspect-[16/10] w-full overflow-hidden">
                            <img src="{{ $lmsScreens[2]['src'] }}" alt="{{ $lmsScreens[2]['label'] }}" loading="lazy" decoding="async" draggable="false" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        </div>
                    </button>

                    {{-- CENTER monitor (Course Player) — desktop monitor with stand, no tilt --}}
                    <button
                        type="button"
                        data-gallery-item
                        data-src="{{ $lmsScreens[1]['src'] }}"
                        data-title="Champions LMS · {{ $lmsScreens[1]['label'] }}"
                        class="lms-monitor group absolute focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--color-accent-gold)]"
                        style="
                            left: 50%;
                            top: 0;
                            width: 40%;
                            z-index: 20;
                            transform: translateX(-50%);
                            animation: hub-screen-in 0.9s cubic-bezier(0.22,1,0.36,1) both;
                            animation-delay: 0.15s;
                        "
                        aria-label="View screenshot: {{ $lmsScreens[1]['label'] }}"
                    >
                        {{-- monitor bezel --}}
                        <div class="lms-monitor__bezel relative overflow-hidden rounded-lg border-[6px] border-white bg-white shadow-[0_30px_80px_-20px_rgba(0,0,0,0.8)] transition-all duration-500 group-hover:shadow-[0_35px_90px_-15px_rgba(244,184,30,0.4)]">
                            <div class="aspect-[16/10] w-full overflow-hidden bg-black">
                                <img src="{{ $lmsScreens[1]['src'] }}" alt="{{ $lmsScreens[1]['label'] }}" loading="lazy" decoding="async" draggable="false" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                            </div>
                        </div>
                        {{-- monitor stand --}}
                        <div aria-hidden="true" class="lms-monitor__stand mx-auto h-[14%] w-[18%]" style="
                            background: linear-gradient(to bottom, #e8e8e8, #b8b8b8);
                            clip-path: polygon(20% 0%, 80% 0%, 100% 100%, 0% 100%);
                            margin-top: -1px;
                        "></div>
                        <div aria-hidden="true" class="mx-auto h-[4%] w-[35%] rounded-b-md" style="background: linear-gradient(to bottom, #d8d8d8, #a8a8a8);"></div>
                    </button>
                </div>
            </div>
        </div>

        {{-- middle: features label (left) + description (right-aligned, narrow) --}}
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-start lg:gap-12">
            <div class="flex flex-col gap-4">
                <x-eyebrow tone="dim">{{ __('sections.features') }}</x-eyebrow>
                <h3 class="text-[clamp(20px,1.8vw,28px)] uppercase leading-[1.1] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">{{ __('sections.built_for_every') }}</h3>
            </div>
            <div class="lg:flex lg:flex-col lg:items-end lg:gap-5">
                <p class="max-w-[42ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                    {{ __('sections.lms_description') }}
                </p>
                <x-visit-button class="mt-5 lg:mt-0" />
            </div>
        </div>

        {{-- 6-stat grid: 2 rows × 3 cols, divider between rows --}}
        @php
            $stats = [
                ['number' => '11',    'label' => __('stats.lms_11_label'),    'caption' => __('stats.lms_11_caption')],
                ['number' => '1000+', 'label' => __('stats.lms_1000_label'),  'caption' => __('stats.lms_1000_caption')],
                ['number' => '5',     'label' => __('stats.lms_5_label'),     'caption' => __('stats.lms_5_caption')],
                ['number' => '50+',   'label' => __('stats.lms_50_label'),    'caption' => __('stats.lms_50_caption')],
                ['number' => '5+',    'label' => __('stats.lms_5plus_label'), 'caption' => __('stats.lms_5plus_caption')],
                ['number' => '24/7',  'label' => __('stats.lms_247_label'),   'caption' => __('stats.lms_247_caption')],
            ];
        @endphp
        <div class="grid grid-cols-1 gap-y-8 sm:grid-cols-2 md:grid-cols-3 md:gap-x-12 md:gap-y-10">
            @foreach ($stats as $i => $stat)
                <div class="flex flex-col gap-3 {{ $i >= 3 ? 'md:border-t md:border-[var(--color-divider)] md:pt-10' : '' }}">
                    <span class="stat-counter text-[clamp(40px,4.8vw,80px)] leading-none tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">{{ $stat['number'] }}</span>
                    <span class="text-[13px] leading-[1.4] text-white md:text-[14px]">{{ $stat['label'] }}</span>
                    <x-eyebrow tone="dim">{{ $stat['caption'] }}</x-eyebrow>
                </div>
            @endforeach
        </div>

        {{-- social --}}
        <div class="mt-2 flex justify-center border-t border-[var(--color-divider)] pt-10">
            <x-social-icons :label="__('sections.follow_us')" align="center" />
        </div>

        {{-- footer --}}
        <x-page-footer index="05" total="12" :label="__('sections.footer_05')" />
    </div>
</section>
