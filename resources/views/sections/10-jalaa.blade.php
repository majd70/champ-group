<section
    id="page-10"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="jalaa-title"
>
    <div class="mx-auto grid max-w-[1440px] grid-cols-1 gap-12 px-6 py-20 md:px-12 md:py-24 lg:grid-cols-2 lg:gap-16 lg:py-28">

        {{-- LEFT COLUMN --}}
        <div class="flex flex-col gap-10">

            {{-- top eyebrow --}}
            <x-eyebrow tone="dim">Champions Group · Founded 1992 · Acquired 2022 · Gaza</x-eyebrow>

            {{-- title: "Al" sits above, then JALAA' + shield share the same row so they align --}}
            <h2 id="jalaa-title" class="flex flex-col gap-1">
                <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(36px,4.5vw,72px)] leading-[0.95] text-[var(--color-accent-gold)]">Al</span>
                <div class="flex items-center gap-12 md:gap-20">
                    <span class="text-[clamp(64px,9vw,150px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">Jalaa&rsquo;</span>
                    <img
                        src="{{ asset('images/page-10/shield.png') }}"
                        alt="Al Jalaa shield logo — orange phoenix emblem"
                        width="420"
                        height="460"
                        class="block h-auto w-[clamp(100px,12vw,170px)] select-none"
                        draggable="false"
                    >
                </div>
            </h2>

            {{-- description --}}
            <p class="max-w-[55ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                One of Gaza&rsquo;s oldest sports clubs — serving all ages and genders across multiple sports. Acquired by Champions Group in 2022, rebranded with a renewed phoenix emblem and now operating as the group&rsquo;s non-profit arm focused on community, education, and athletic development.
            </p>

            {{-- horizontal divider --}}
            <hr class="border-0 border-t border-[var(--color-divider)]">

            {{-- founded year stacked 19 / 92 --}}
            <div class="flex items-end gap-6 md:gap-10">
                <span
                    class="text-eyebrow shrink-0 text-[var(--color-text-dim)] whitespace-nowrap"
                    style="writing-mode: vertical-rl; transform: rotate(180deg);"
                >Founded</span>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col leading-[0.85]">
                        <span class="stat-counter text-[clamp(64px,10vw,160px)] tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">19</span>
                        <span class="stat-counter text-[clamp(64px,10vw,160px)] tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">92</span>
                    </div>
                    <x-eyebrow tone="dim">Year Founded · Palestinian Second Division</x-eyebrow>
                </div>
            </div>

            {{-- ambitions --}}
            <p class="text-[13px] leading-[1.5] text-[var(--color-text-muted)] md:text-[14px]">
                <span class="text-[var(--color-display-cream)]">Ambitions:</span> Win the Palestinian league and compete internationally.
            </p>

            {{-- CTA --}}
            <x-visit-button />
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="flex flex-col gap-10 lg:gap-0 lg:border-l lg:border-[var(--color-divider)] lg:pl-12">

            {{-- 2x2 photos collage --}}
            <img
                src="{{ asset('images/page-10/photos.jpg') }}"
                alt="Al Jalaa football teams in orange jerseys: current squad, beach football team, vintage team photo, and celebration photo"
                width="1320"
                height="800"
                class="block w-full select-none"
                draggable="false"
            >

            {{-- 6-stat grid + footer pushed to bottom of column --}}
            @php
                $stats = [
                    ['number' => '9,000', 'label' => 'Fans & Supporters',  'caption' => 'Community'],
                    ['number' => '9',     'label' => 'Sports Disciplines', 'caption' => 'Breadth'],
                    ['number' => '40',    'label' => 'Championships Won',  'caption' => 'Honors'],
                    ['number' => '34',    'label' => 'Years of Heritage',  'caption' => 'Legacy'],
                    ['number' => '50',    'label' => 'Active Players',     'caption' => 'Roster'],
                    ['number' => '1992',  'label' => 'Year Founded',       'caption' => 'Origin'],
                ];
            @endphp
            <div class="mt-10 flex flex-col gap-10 lg:mt-auto lg:pt-12">
                <div class="grid grid-cols-3 gap-x-4 gap-y-6 md:gap-x-6 md:gap-y-8">
                    @foreach ($stats as $i => $stat)
                        <div class="flex flex-col gap-2 {{ $i >= 3 ? 'md:border-t md:border-[var(--color-divider)] md:pt-6' : '' }}">
                            <span class="stat-counter text-[clamp(30px,3.8vw,60px)] leading-none tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">{{ $stat['number'] }}</span>
                            <span class="text-[12px] leading-[1.4] text-white md:text-[13px]">{{ $stat['label'] }}</span>
                            <x-eyebrow tone="dim">{{ $stat['caption'] }}</x-eyebrow>
                        </div>
                    @endforeach
                </div>

                <x-page-footer index="10" total="12" label="Al Jalaa · Gaza Venture" />
            </div>
        </div>
    </div>
</section>
