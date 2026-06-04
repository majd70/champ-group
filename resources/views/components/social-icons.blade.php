@props([
    'label' => null,
    'align' => 'start',
    'links' => [
        ['platform' => 'facebook',  'href' => '#'],
        ['platform' => 'instagram', 'href' => '#'],
        ['platform' => 'linkedin',  'href' => '#'],
        ['platform' => 'twitter',   'href' => '#'],
        ['platform' => 'youtube',   'href' => '#'],
    ],
])

@php
    $alignClass = match ($align) {
        'center' => 'items-center justify-center text-center',
        'end'    => 'items-end justify-end text-end',
        default  => 'items-start justify-start text-start',
    };
@endphp

<div {{ $attributes->class(['social-icons flex flex-col gap-3', $alignClass]) }}>
    @if ($label)
        <span class="text-[10.5px] font-medium uppercase tracking-[0.22em] text-[var(--color-text-dim)]">
            {{ $label }}
        </span>
    @endif

    <div class="flex items-center gap-3">
        @foreach ($links as $link)
            @php $platform = $link['platform']; @endphp
            <a
                href="{{ $link['href'] }}"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="{{ ucfirst($platform) }}"
                style="width:44px;height:44px;"
                class="group inline-flex shrink-0 items-center justify-center rounded-full border border-white/15 bg-white/[0.06] text-[var(--color-text-muted)] transition-all duration-300 hover:scale-[1.08] hover:border-[var(--color-accent-gold)]/55 hover:bg-[var(--color-accent-gold)]/15 hover:text-[var(--color-accent-gold)]"
            >
                @switch($platform)
                    @case('facebook')
                        <svg style="width:18px;height:18px;" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M22 12a10 10 0 1 0-11.5 9.9v-7H7.9V12h2.6V9.8c0-2.6 1.5-4 3.9-4 1.1 0 2.3.2 2.3.2v2.5h-1.3c-1.3 0-1.7.8-1.7 1.6V12h2.9l-.5 2.9h-2.4v7A10 10 0 0 0 22 12z"/>
                        </svg>
                        @break
                    @case('instagram')
                        <svg style="width:18px;height:18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="2" width="20" height="20" rx="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                        @break
                    @case('linkedin')
                        <svg style="width:18px;height:18px;" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M20.45 20.45h-3.55v-5.57c0-1.33-.03-3.04-1.85-3.04-1.86 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.42v1.56h.04c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.43A2.06 2.06 0 1 1 5.34 3.31a2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.55V9h3.57v11.45z"/>
                        </svg>
                        @break
                    @case('twitter')
                    @case('x')
                        <svg style="width:16px;height:16px;" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M18.24 2.25h3.31l-7.23 8.26L22.83 21.75H16.17l-5.21-6.82-5.97 6.82H1.68l7.73-8.84L1.25 2.25H8.08l4.71 6.23 5.45-6.23zm-1.16 17.52h1.83L7.08 4.13H5.12l11.96 15.64z"/>
                        </svg>
                        @break
                    @case('youtube')
                        <svg style="width:18px;height:18px;" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.5A3.02 3.02 0 0 0 .5 6.19C0 8.07 0 12 0 12s0 3.93.5 5.81a3.02 3.02 0 0 0 2.12 2.14C4.5 20.45 12 20.45 12 20.45s7.5 0 9.38-.5a3.02 3.02 0 0 0 2.12-2.14c.5-1.88.5-5.81.5-5.81s0-3.93-.5-5.81zM9.55 15.57V8.43L15.82 12l-6.27 3.57z"/>
                        </svg>
                        @break
                    @case('tiktok')
                        <svg style="width:18px;height:18px;" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5.8 20.1a6.34 6.34 0 0 0 10.86-4.43V8.71a8.16 8.16 0 0 0 4.77 1.52V6.78a4.83 4.83 0 0 1-1.84-.09z"/>
                        </svg>
                        @break
                @endswitch
            </a>
        @endforeach
    </div>
</div>
