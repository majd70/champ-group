@php
    $links = [
        ['href' => '#page-01', 'label' => 'Home'],
        ['href' => '#page-02', 'label' => 'Partners'],
        ['href' => '#page-03', 'label' => 'Services'],
        ['href' => '#page-04', 'label' => 'Hub'],
        ['href' => '#page-05', 'label' => 'LMS'],
        ['href' => '#page-06', 'label' => 'Academy'],
        ['href' => '#page-08', 'label' => 'Club'],
        ['href' => '#page-10', 'label' => "Al Jalaa'"],
        ['href' => '#page-11', 'label' => 'EgytalHub'],
        ['href' => '#footer',  'label' => 'Contact'],
    ];
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
                Champions Group
            </span>
        </a>

        {{-- Desktop nav: flex-1 + justify-around fills remaining space evenly --}}
        <ul class="hidden flex-1 items-center justify-around pl-10 xl:pl-16 lg:flex">
            @foreach ($links as $link)
                <li>
                    <a
                        href="{{ $link['href'] }}"
                        class="nav-link text-[11px] font-medium uppercase tracking-[0.14em] text-white/80 transition-colors hover:text-[var(--color-accent-gold)]"
                    >{{ $link['label'] }}</a>
                </li>
            @endforeach
        </ul>

        {{-- Mobile hamburger --}}
        <button
            type="button"
            class="ml-auto inline-flex h-10 w-10 items-center justify-center text-white transition-colors hover:text-[var(--color-accent-gold)] lg:hidden"
            aria-label="Toggle navigation menu"
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
        </ul>
    </div>
</header>

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

    // close on viewport resize to lg+
    const mq = window.matchMedia('(min-width: 1024px)');
    mq.addEventListener('change', (e) => { if (e.matches) setOpen(false); });
})();
</script>
