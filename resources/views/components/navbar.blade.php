@php
    $links = [
        ['href' => '#page-01', 'label' => __('nav.home')],
        ['href' => '#page-02', 'label' => __('nav.partners')],
        ['href' => '#page-03', 'label' => __('nav.services')],
        ['href' => '#page-04', 'label' => __('nav.hub')],
        ['href' => '#page-05', 'label' => __('nav.lms')],
        ['href' => '#page-06', 'label' => __('nav.academy')],
        ['href' => '#page-08', 'label' => __('nav.club')],
        ['href' => '#page-10', 'label' => __('nav.al_jalaa')],
        ['href' => '#page-11', 'label' => __('nav.egytalhub')],
        ['href' => '#footer',  'label' => __('nav.contact')],
    ];
    $locales = config('app.available_locales', []);
    $currentLocale = app()->getLocale();
    $currentLocaleData = $locales[$currentLocale] ?? ['native' => strtoupper($currentLocale)];
@endphp

<header
    class="fixed inset-x-0 top-0 z-50 border-b border-[var(--color-divider)]/60 bg-[var(--color-bg-navy)]/85 backdrop-blur-md"
    aria-label="Site header"
>
    <nav
        class="flex w-full items-center gap-4 px-6 py-3 md:px-10 md:py-4"
        aria-label="Primary navigation"
    >
        {{-- Logo --}}
        <a href="#page-01" class="flex shrink-0 items-center gap-3" aria-label="Champions Group — home">
            <img
                src="{{ asset('images/page-01/shield.png') }}"
                alt=""
                width="680"
                height="920"
                class="block h-8 w-auto select-none md:h-10"
                draggable="false"
            >
            <span class="hidden text-[12px] font-semibold uppercase tracking-[0.18em] text-white sm:inline md:text-[13px]">
                {{ __('brands.group') }}
            </span>
        </a>

        {{-- Desktop nav: flex-1 + justify-around fills remaining space evenly --}}
        <ul class="hidden flex-1 items-center justify-around ps-10 xl:ps-16 lg:flex">
            @foreach ($links as $link)
                <li>
                    <a
                        href="{{ $link['href'] }}"
                        class="nav-link text-[11px] font-medium uppercase tracking-[0.14em] text-white/80 transition-colors hover:text-[var(--color-accent-gold)]"
                    >{{ $link['label'] }}</a>
                </li>
            @endforeach
        </ul>

        {{-- Language switcher (desktop) --}}
        <div class="relative ms-auto hidden lg:block" x-data="{ open: false }">
            <button
                type="button"
                @click="open = !open"
                :aria-expanded="open"
                aria-haspopup="menu"
                aria-label="{{ __('general.change_language') }}"
                class="flex items-center gap-2 px-3 py-2 text-[11px] font-medium uppercase tracking-[0.14em] text-white/80 transition-colors hover:text-[var(--color-accent-gold)]"
            >
                <span aria-hidden="true">{{ $currentLocaleData['flag'] ?? '' }}</span>
                <span>{{ $currentLocaleData['native'] ?? strtoupper($currentLocale) }}</span>
                <svg class="h-3 w-3 transition-transform duration-200" :class="{ 'rotate-180': open }" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
                    <path d="M3 4.5l3 3 3-3"/>
                </svg>
            </button>

            <div
                x-show="open"
                x-cloak
                @click.outside="open = false"
                @keydown.escape.window="open = false"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                role="menu"
                class="absolute end-0 mt-2 min-w-[160px] rounded-sm border border-white/10 bg-[var(--color-bg-navy)] py-2 shadow-2xl"
            >
                @foreach ($locales as $code => $locale)
                    @php $isActive = $code === $currentLocale; @endphp
                    <a
                        href="{{ route('locale.switch', $code) }}"
                        role="menuitem"
                        @class([
                            'flex items-center gap-3 px-4 py-2 text-[12px] uppercase tracking-[0.14em] transition-colors',
                            'text-[var(--color-accent-gold)]' => $isActive,
                            'text-white/75 hover:bg-white/5 hover:text-white' => !$isActive,
                        ])
                    >
                        <span aria-hidden="true">{{ $locale['flag'] ?? '' }}</span>
                        <span>{{ $locale['name'] ?? $code }}</span>
                        @if ($isActive)
                            <svg class="ms-auto h-3 w-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M2 6l3 3 5-7"/>
                            </svg>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Mobile hamburger --}}
        <button
            type="button"
            class="ms-auto inline-flex h-10 w-10 items-center justify-center text-white transition-colors hover:text-[var(--color-accent-gold)] lg:hidden"
            aria-label="{{ __('general.toggle_menu') }}"
            aria-expanded="false"
            aria-controls="mobile-nav-panel"
            data-nav-toggle
        >
            <svg data-nav-icon="menu" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                <path d="M3 6h18M3 12h18M3 18h18"/>
            </svg>
            <svg data-nav-icon="close" class="hidden h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                <path d="M6 6l12 12M18 6L6 18"/>
            </svg>
        </button>
    </nav>

    {{-- Mobile menu panel --}}
    <div
        id="mobile-nav-panel"
        class="grid max-h-0 overflow-hidden border-t-0 border-[var(--color-divider)]/60 bg-[var(--color-bg-navy)] transition-[max-height,border-top-width] duration-300 ease-out lg:hidden"
        data-nav-panel
    >
        <ul class="flex w-full flex-col px-6 py-3 md:px-10">
            @foreach ($links as $link)
                <li>
                    <a
                        href="{{ $link['href'] }}"
                        class="block border-b border-[var(--color-divider)]/40 py-3 text-[12px] font-medium uppercase tracking-[0.18em] text-white/85 transition-colors last:border-b-0 hover:text-[var(--color-accent-gold)]"
                        data-nav-link
                    >{{ $link['label'] }}</a>
                </li>
            @endforeach

            {{-- Mobile language list --}}
            <li class="border-t border-[var(--color-divider)]/40 pt-3 mt-2">
                <p class="mb-1 text-[10px] font-medium uppercase tracking-[0.2em] text-[var(--color-text-dim)]">{{ __('general.select_language') }}</p>
                <div class="flex flex-wrap gap-2">
                    @foreach ($locales as $code => $locale)
                        @php $isActive = $code === $currentLocale; @endphp
                        <a
                            href="{{ route('locale.switch', $code) }}"
                            @class([
                                'inline-flex items-center gap-1.5 rounded-sm border px-3 py-1.5 text-[11px] uppercase tracking-[0.14em]',
                                'border-[var(--color-accent-gold)] text-[var(--color-accent-gold)]' => $isActive,
                                'border-white/15 text-white/80 hover:border-white/30' => !$isActive,
                            ])
                        >
                            <span aria-hidden="true">{{ $locale['flag'] ?? '' }}</span>
                            <span>{{ $locale['native'] ?? strtoupper($code) }}</span>
                        </a>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</header>

<style>[x-cloak]{display:none!important}</style>

<script>
(function () {
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    const menuIcon = document.querySelector('[data-nav-icon="menu"]');
    const closeIcon = document.querySelector('[data-nav-icon="close"]');
    const links = document.querySelectorAll('[data-nav-link]');

    if (!toggle || !panel) return;

    function setOpen(open) {
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (open) {
            panel.style.maxHeight = panel.scrollHeight + 'px';
            panel.classList.add('border-t');
        } else {
            panel.style.maxHeight = '0px';
            panel.classList.remove('border-t');
        }
        menuIcon.classList.toggle('hidden', open);
        closeIcon.classList.toggle('hidden', !open);
    }

    toggle.addEventListener('click', () => {
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';
        setOpen(!isOpen);
    });

    links.forEach((link) => link.addEventListener('click', () => setOpen(false)));

    const mq = window.matchMedia('(min-width: 1024px)');
    mq.addEventListener('change', (e) => { if (e.matches) setOpen(false); });
})();
</script>
