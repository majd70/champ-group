<section
    id="page-11"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="egytalhub-title"
>
    <div class="mx-auto grid max-w-[1440px] grid-cols-1 gap-12 px-6 py-20 md:px-12 md:py-24 lg:grid-cols-2 lg:gap-16 lg:py-28">

        {{-- LEFT COLUMN --}}
        <div class="flex flex-col gap-10">

            {{-- top eyebrow --}}
            <x-eyebrow tone="dim">{{ __('sections.egytal_eyebrow') }}</x-eyebrow>

            {{-- title (no italic prefix on this page) --}}
            <h2 id="egytalhub-title" class="text-[clamp(56px,8.5vw,150px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">
                {{ __('titles.egytalhub') }}
            </h2>

            {{-- description --}}
            <p class="max-w-[50ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                {{ __('sections.egytal_description') }}
            </p>

            {{-- CTA --}}
            <x-visit-button />

            {{-- horizontal divider --}}
            <hr class="border-0 border-t border-[var(--color-divider)]">

            {{-- track record: vertical eyebrow + 53+ + caption --}}
            <div class="flex items-end gap-6 md:gap-10">
                <span
                    class="text-eyebrow shrink-0 text-[var(--color-text-dim)] whitespace-nowrap"
                    style="writing-mode: vertical-rl; transform: rotate(180deg);"
                >{{ __('sections.track_record') }}</span>
                <div class="flex flex-col gap-3">
                    <span class="stat-counter text-[clamp(64px,10vw,160px)] leading-[0.9] tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">53+</span>
                    <x-eyebrow tone="dim">{{ __('sections.projects_delivered') }}</x-eyebrow>
                </div>
            </div>

            {{-- tagline --}}
            <p class="text-[13px] leading-[1.5] text-[var(--color-text-muted)] md:text-[14px]">
                {{ __('sections.egytal_tagline') }}
            </p>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="flex flex-col gap-10 lg:gap-0 lg:border-s lg:border-[var(--color-divider)] lg:ps-12">

            {{-- Egytalhub logo --}}
            <div class="flex items-center justify-center py-4">
                <img
                    src="{{ asset('images/page-11/logo.png') }}"
                    alt="Egytalhub logo — orange triangle with teal accents and EGYTALHUB wordmark"
                    width="350"
                    height="340"
                    class="block h-auto w-[clamp(160px,18vw,260px)] select-none"
                    draggable="false"
                >
            </div>

            {{-- 6-stat grid (Egytalhub orange accent) + footer pushed down --}}
            @php
                $stats = [
                    ['number' => '66+',    'label' => __('stats.egytal_66_label'),  'caption' => __('stats.egytal_66_caption')],
                    ['number' => '50%',    'label' => __('stats.egytal_50_label'),  'caption' => __('stats.egytal_50_caption')],
                    ['number' => '34+',    'label' => __('stats.egytal_34_label'),  'caption' => __('stats.egytal_34_caption')],
                    ['number' => '350+',   'label' => __('stats.egytal_350_label'), 'caption' => __('stats.egytal_350_caption')],
                    ['number' => '72 HRS', 'label' => __('stats.egytal_72_label'),  'caption' => __('stats.egytal_72_caption')],
                    ['number' => '95%',    'label' => __('stats.egytal_95_label'),  'caption' => __('stats.egytal_95_caption')],
                ];
            @endphp
            <div class="mt-10 flex flex-col gap-10 lg:mt-auto lg:pt-8">
                <div class="grid grid-cols-3 gap-x-4 gap-y-6 md:gap-x-6 md:gap-y-8">
                    @foreach ($stats as $i => $stat)
                        <div class="flex flex-col gap-2 {{ $i >= 3 ? 'md:border-t md:border-[var(--color-divider)] md:pt-6' : '' }}">
                            <span class="stat-counter text-[clamp(28px,3.4vw,52px)] leading-none tabular-nums" style="font-family: var(--font-display); color: var(--color-accent-gold);">{{ $stat['number'] }}</span>
                            <span class="text-[12px] leading-[1.4] text-white md:text-[13px]">{{ $stat['label'] }}</span>
                            <x-eyebrow tone="dim">{{ $stat['caption'] }}</x-eyebrow>
                        </div>
                    @endforeach
                </div>

                <x-page-footer index="11" total="12" :label="__('sections.footer_11')" />
            </div>
        </div>
    </div>
</section>
