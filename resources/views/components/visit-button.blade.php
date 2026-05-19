@props([
    'href' => '/',
    'label' => 'Visit our website',
])

<a
    href="{{ $href }}"
    {{ $attributes->class([
        'visit-button group inline-flex items-center gap-2.5 self-start rounded-sm border border-[var(--color-accent-gold)] px-7 py-3.5 text-[12px] font-semibold uppercase tracking-[0.14em] text-[var(--color-accent-gold)] transition-all duration-300 hover:bg-[var(--color-accent-gold)] hover:text-[var(--color-bg-navy)] hover:shadow-[0_0_24px_-6px_rgba(244,184,30,0.55)] md:text-[13px]',
    ]) }}
>
    <span>{{ $label }}</span>
    <svg
        class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        aria-hidden="true"
    >
        <path d="M5 12h14M13 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>
