@php
    // Footer "Explore" column — uses translated nav labels
    $exploreLinks = [
        ['href' => '#page-01', 'label' => __('nav.home')],
        ['href' => '#page-02', 'label' => __('nav.partners')],
        ['href' => '#page-03', 'label' => __('nav.services')],
        ['href' => '#page-04', 'label' => __('nav.hub')],
        ['href' => '#page-05', 'label' => __('nav.lms')],
        ['href' => '#page-06', 'label' => __('nav.academy')],
        ['href' => '#page-08', 'label' => __('nav.club')],
        ['href' => '#page-10', 'label' => __('nav.al_jalaa')],
        ['href' => '#page-11', 'label' => __('nav.egytalhub')],
    ];

    // Brand names translated via brands.php so Arabic mode is fully localized
    $brands = [
        ['href' => '#page-06', 'label' => __('brands.academy')],
        ['href' => '#page-08', 'label' => __('brands.club')],
        ['href' => '#page-04', 'label' => __('brands.hub')],
        ['href' => '#page-05', 'label' => __('brands.lms')],
        ['href' => '#page-10', 'label' => __('brands.al_jalaa')],
        ['href' => '#page-11', 'label' => __('brands.egytalhub')],
    ];
@endphp

<footer id="footer" class="relative w-full bg-[#060e22] pt-20 pb-10 text-[var(--color-display-cream)]">
    {{-- thin gold accent line at the top of the footer --}}
    <div aria-hidden="true" class="absolute inset-x-0 top-0 h-px bg-[var(--color-accent-gold)]/40"></div>

    <div class="mx-auto w-full px-6 md:px-10">

        {{-- 4-column grid: 1 col mobile, 2 col tablet, 4 col desktop --}}
        <div class="grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1.1fr] lg:gap-10">

            {{-- COLUMN 1: BRAND --}}
            <div class="flex flex-col gap-5">
                <a href="#page-01" class="inline-flex items-center gap-3" aria-label="Champions Group — home">
                    <img
                        src="{{ asset('images/page-01/shield.png') }}"
                        alt=""
                        width="680"
                        height="920"
                        class="block h-12 w-auto select-none"
                        draggable="false"
                    >
                    <span class="text-[14px] font-semibold uppercase tracking-[0.18em] text-white">
                        {{ __('brands.group') }}
                    </span>
                </a>

                <p class="max-w-[42ch] text-[13px] leading-[1.65] text-[#a8b0c2]">
                    {{ __('footer.tagline') }}
                </p>

                <span class="text-[11px] font-medium uppercase tracking-[0.18em] text-[var(--color-text-dim)]">
                    {{ __('footer.established') }}
                </span>
            </div>

            {{-- COLUMN 2: EXPLORE --}}
            <div class="flex flex-col gap-5">
                <h3 class="text-[12px] font-semibold uppercase tracking-[0.18em] text-[var(--color-accent-gold)]">
                    {{ __('footer.explore') }}
                </h3>
                <ul class="flex flex-col gap-2.5 text-[13px]">
                    @foreach ($exploreLinks as $link)
                        <li>
                            <a
                                href="{{ $link['href'] }}"
                                class="text-[var(--color-display-cream)] transition-colors hover:text-[var(--color-accent-gold)]"
                            >{{ $link['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- COLUMN 3: OUR BRANDS --}}
            <div class="flex flex-col gap-5">
                <h3 class="text-[12px] font-semibold uppercase tracking-[0.18em] text-[var(--color-accent-gold)]">
                    {{ __('footer.our_brands') }}
                </h3>
                <ul class="flex flex-col gap-2.5 text-[13px]">
                    @foreach ($brands as $brand)
                        <li>
                            <a
                                href="{{ $brand['href'] }}"
                                class="text-[var(--color-display-cream)] transition-colors hover:text-[var(--color-accent-gold)]"
                            >{{ $brand['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- COLUMN 4: GET IN TOUCH --}}
            <div class="flex flex-col gap-5">
                <h3 class="text-[12px] font-semibold uppercase tracking-[0.18em] text-[var(--color-accent-gold)]">
                    {{ __('footer.get_in_touch') }}
                </h3>

                <ul class="flex flex-col gap-3 text-[13px]">
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-[var(--color-text-dim)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="2"/>
                            <path d="M3 7l9 6 9-6"/>
                        </svg>
                        <a href="mailto:{{ __('footer.email') }}" class="text-[var(--color-display-cream)] transition-colors hover:text-[var(--color-accent-gold)]">
                            {{ __('footer.email') }}
                        </a>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-[var(--color-text-dim)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        <a href="tel:+970000000000" class="text-[var(--color-display-cream)] transition-colors hover:text-[var(--color-accent-gold)]">
                            {{ __('footer.phone') }}
                        </a>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-[var(--color-text-dim)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <span class="text-[var(--color-display-cream)]">{{ __('footer.mena_region') }}</span>
                    </li>
                </ul>

                {{-- Social icons --}}
                <div class="mt-2 flex items-center gap-4">
                    <a href="#" aria-label="Facebook" class="text-[var(--color-text-muted)] transition-colors hover:text-[var(--color-accent-gold)]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M22 12a10 10 0 1 0-11.5 9.9v-7H7.9V12h2.6V9.8c0-2.6 1.5-4 3.9-4 1.1 0 2.3.2 2.3.2v2.5h-1.3c-1.3 0-1.7.8-1.7 1.6V12h2.9l-.5 2.9h-2.4v7A10 10 0 0 0 22 12z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="text-[var(--color-text-muted)] transition-colors hover:text-[var(--color-accent-gold)]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="2" width="20" height="20" rx="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="LinkedIn" class="text-[var(--color-text-muted)] transition-colors hover:text-[var(--color-accent-gold)]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M20.45 20.45h-3.55v-5.57c0-1.33-.03-3.04-1.85-3.04-1.86 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.42v1.56h.04c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.43A2.06 2.06 0 1 1 5.34 3.31a2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.55V9h3.57v11.45z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="X (Twitter)" class="text-[var(--color-text-muted)] transition-colors hover:text-[var(--color-accent-gold)]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M18.24 2.25h3.31l-7.23 8.26L22.83 21.75H16.17l-5.21-6.82-5.97 6.82H1.68l7.73-8.84L1.25 2.25H8.08l4.71 6.23 5.45-6.23zm-1.16 17.52h1.83L7.08 4.13H5.12l11.96 15.64z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="YouTube" class="text-[var(--color-text-muted)] transition-colors hover:text-[var(--color-accent-gold)]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.5A3.02 3.02 0 0 0 .5 6.19C0 8.07 0 12 0 12s0 3.93.5 5.81a3.02 3.02 0 0 0 2.12 2.14C4.5 20.45 12 20.45 12 20.45s7.5 0 9.38-.5a3.02 3.02 0 0 0 2.12-2.14c.5-1.88.5-5.81.5-5.81s0-3.93-.5-5.81zM9.55 15.57V8.43L15.82 12l-6.27 3.57z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- gold divider above bottom bar --}}
        <div aria-hidden="true" class="mt-16 h-px w-full bg-[var(--color-accent-gold)]/25"></div>

        {{-- BOTTOM BAR --}}
        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-[12px] text-[var(--color-text-dim)]">
                {{ __('footer.copyright', ['year' => date('Y')]) }}
            </p>
            <div class="flex items-center gap-6 text-[12px]">
                <a href="#" class="text-[var(--color-text-dim)] transition-colors hover:text-[var(--color-accent-gold)]">{{ __('footer.privacy_policy') }}</a>
                <a href="#" class="text-[var(--color-text-dim)] transition-colors hover:text-[var(--color-accent-gold)]">{{ __('footer.terms') }}</a>
            </div>
        </div>
    </div>
</footer>
