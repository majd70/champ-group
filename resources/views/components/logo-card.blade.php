@props([
    'image' => null,
    'name' => null,
    'aspectRatio' => 'aspect-[16/9]',
])

<div
    {{ $attributes->class([
        'logo-card group flex items-center justify-center rounded-[4px] border border-white/10 bg-white/[0.04] p-3 transition-all duration-300 hover:scale-[1.03] hover:border-white/25 hover:bg-white/[0.06]',
        $aspectRatio,
    ]) }}
    @if ($name) title="{{ $name }}" @endif
>
    @if ($image)
        <img
            src="{{ $image }}"
            alt="{{ $name ?? '' }}"
            class="max-h-[60%] max-w-[70%] object-contain"
            loading="lazy"
            decoding="async"
            draggable="false"
        >
    @else
        {{-- empty placeholder icon, faint --}}
        <svg
            class="h-6 w-6 text-white/15"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true"
        >
            <rect x="3" y="3" width="18" height="18" rx="2"/>
            <circle cx="9" cy="9" r="2"/>
            <path d="M21 15l-5-5L5 21"/>
        </svg>
        @if ($name)
            <span class="sr-only">{{ $name }}</span>
        @endif
    @endif
</div>
