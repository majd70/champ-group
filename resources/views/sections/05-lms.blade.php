<section
    id="page-05"
    class="relative w-full bg-[var(--color-bg-navy)]"
    aria-labelledby="lms-title"
>
    <div class="mx-auto flex max-w-[1440px] flex-col gap-12 px-6 py-20 md:px-12 md:py-24 lg:py-28">

        {{-- top eyebrow --}}
        <x-eyebrow tone="gold">Champions Group · Learning Platform</x-eyebrow>

        {{-- top zone: title (left) + laptops (right) --}}
        <div class="grid grid-cols-1 items-end gap-10 lg:grid-cols-[1fr_2.3fr] lg:gap-8">
            <h2 id="lms-title" class="flex flex-col">
                <span style="font-family: var(--font-italic); font-style: italic;" class="text-[clamp(40px,5.5vw,90px)] leading-[0.95] text-[var(--color-accent-gold)]">Champions</span>
                <span class="text-[clamp(80px,12vw,180px)] uppercase leading-[0.88] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">LMS</span>
            </h2>

            <img
                src="{{ asset('images/page-05/laptops.png') }}"
                alt="Champions LMS platform: 3 product screens on desktop and laptop devices"
                width="1850"
                height="580"
                class="block w-full select-none"
                draggable="false"
            >
        </div>

        {{-- middle: features label (left) + description (right-aligned, narrow) --}}
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-start lg:gap-12">
            <div class="flex flex-col gap-4">
                <x-eyebrow tone="dim">Features</x-eyebrow>
                <h3 class="text-[clamp(20px,1.8vw,28px)] uppercase leading-[1.1] text-[var(--color-display-cream)]" style="font-family: var(--font-display);">Built for every learner.</h3>
            </div>
            <div class="lg:flex lg:justify-end">
                <p class="max-w-[42ch] text-[14px] leading-[1.7] text-[var(--color-text-muted)] md:text-[15px]">
                    A complete multi-tenant learning platform — combining AI-powered mentoring, interactive learning, advanced gamification, live streaming and full white-label branding for training teams, course creators, coaches and enterprise.
                </p>
            </div>
        </div>

        {{-- 6-stat grid: 2 rows × 3 cols, divider between rows --}}
        @php
            $stats = [
                ['number' => '11',    'label' => 'Lesson Types',       'caption' => 'From Video to Quizzes'],
                ['number' => '1000+', 'label' => 'Active Learners',    'caption' => 'Across 9 Customers'],
                ['number' => '5',     'label' => 'AI Mentor Personas', 'caption' => 'With Long-Term Memory'],
                ['number' => '50+',   'label' => 'Courses Hosted',     'caption' => 'Multi-Tenant Library'],
                ['number' => '5+',    'label' => 'Languages',          'caption' => 'With RTL Support'],
                ['number' => '24/7',  'label' => 'AI Companion',       'caption' => 'Time-Aware Greetings'],
            ];
        @endphp
        <div class="grid grid-cols-1 gap-y-8 sm:grid-cols-2 md:grid-cols-3 md:gap-x-12 md:gap-y-10">
            @foreach ($stats as $i => $stat)
                <div class="flex flex-col gap-3 {{ $i >= 3 ? 'md:border-t md:border-[var(--color-divider)] md:pt-10' : '' }}">
                    <span class="text-[clamp(40px,4.8vw,80px)] leading-none tabular-nums text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">{{ $stat['number'] }}</span>
                    <span class="text-[13px] leading-[1.4] text-white md:text-[14px]">{{ $stat['label'] }}</span>
                    <x-eyebrow tone="dim">{{ $stat['caption'] }}</x-eyebrow>
                </div>
            @endforeach
        </div>

        {{-- footer --}}
        <x-page-footer index="05" total="12" label="Champions LMS · Learning Platform" />
    </div>
</section>
