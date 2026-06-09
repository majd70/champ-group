@props(['dir' => 'ltr'])

{{--
    Story viewer shell. Slides, progress segments and text blocks are built
    at runtime by public/js/stories.js from the [data-stories-data] payload.
    Hidden until opened (.is-open toggled by JS).
--}}
<div
    class="stories-viewer"
    data-stories-viewer
    data-dir="{{ $dir }}"
    role="dialog"
    aria-modal="true"
    aria-label="{{ __('stories.tray_label') }}"
    aria-hidden="true"
    hidden
>
    <div class="stories-viewer__backdrop" data-stories-close></div>

    <div class="stories-viewer__stage" data-stories-stage>

        {{-- progress segments (one per slide) --}}
        <div class="stories-viewer__progress" data-stories-progress aria-label="{{ __('stories.progress') }}"></div>

        {{-- header --}}
        <header class="stories-viewer__header">
            <span class="stories-viewer__avatar" data-stories-avatar aria-hidden="true">
                <img src="" alt="" draggable="false">
            </span>
            <span class="stories-viewer__meta">
                <span class="stories-viewer__label" data-stories-label></span>
                <span class="stories-viewer__date" data-stories-date></span>
            </span>

            <button type="button" class="stories-viewer__ctrl" data-stories-mute hidden
                aria-label="{{ __('stories.mute') }}">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path data-icon-mute d="M11 5 6 9H2v6h4l5 4V5z"/><path data-icon-mute d="M19 9l-6 6M13 9l6 6"/>
                    <path data-icon-unmute hidden d="M11 5 6 9H2v6h4l5 4V5z"/><path data-icon-unmute hidden d="M15.5 8.5a5 5 0 0 1 0 7M18.5 5.5a9 9 0 0 1 0 13"/>
                </svg>
            </button>

            <button type="button" class="stories-viewer__ctrl" data-stories-close
                aria-label="{{ __('stories.close') }}">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M6 6l12 12M18 6L6 18"/>
                </svg>
            </button>
        </header>

        {{-- slide canvas --}}
        <div class="stories-viewer__canvas" data-stories-canvas>
            {{-- media + text injected per slide --}}
            <div class="stories-viewer__loading" data-stories-loading aria-hidden="true">
                <span class="stories-spinner"></span>
            </div>
        </div>

        {{-- tap zones (prev / next). RTL handled in JS. --}}
        <button type="button" class="stories-viewer__tap stories-viewer__tap--prev" data-stories-prev aria-label="{{ __('stories.previous') }}"></button>
        <button type="button" class="stories-viewer__tap stories-viewer__tap--next" data-stories-next aria-label="{{ __('stories.next') }}"></button>
    </div>

    {{-- error state --}}
    <div class="stories-viewer__error" data-stories-error hidden>
        <p>{{ __('stories.error') }}</p>
        <button type="button" data-stories-close>{{ __('stories.close') }}</button>
    </div>
</div>
