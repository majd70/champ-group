@php
    use App\Support\StoryRepository;

    $locale  = app()->getLocale();
    $dir     = config('app.available_locales.' . $locale . '.dir', 'ltr');
    $stories = StoryRepository::all($locale);
@endphp

@if (!empty($stories))
    {{-- ============================ TRAY ============================ --}}
    <section
        class="stories-tray-section w-full bg-[var(--color-bg-navy)]"
        aria-label="{{ __('stories.tray_a11y') }}"
        data-stories-tray-section
    >
        <div class="mx-auto max-w-[1440px] px-4 py-4 md:px-12 md:py-5">
            <ul
                class="stories-tray flex items-start gap-3 overflow-x-auto md:gap-5"
                data-stories-tray
                role="list"
            >
                @foreach ($stories as $story)
                    <li class="shrink-0">
                        <button
                            type="button"
                            class="stories-bubble group flex w-[76px] flex-col items-center gap-2 md:w-[88px]"
                            data-story-open
                            data-story-id="{{ $story['id'] }}"
                            data-story-version="{{ $story['version'] }}"
                            aria-label="{{ __('stories.open_story', ['name' => $story['label']]) }}"
                        >
                            <span class="stories-bubble__ring" aria-hidden="true">
                                <span class="stories-bubble__inner">
                                    <img
                                        src="{{ $story['thumb'] }}"
                                        alt=""
                                        width="72"
                                        height="72"
                                        loading="lazy"
                                        decoding="async"
                                        draggable="false"
                                        class="stories-bubble__img"
                                    >
                                </span>
                                @if (!empty($story['badge']))
                                    <span class="stories-bubble__badge">{{ $story['badge'] }}</span>
                                @endif
                            </span>
                            <span class="stories-bubble__label">{{ $story['label'] }}</span>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Story payload for the viewer (built by public/js/stories.js) --}}
    <script type="application/json" data-stories-data>@json($stories, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)</script>

    {{-- ============================ VIEWER ============================ --}}
    <x-stories.viewer :dir="$dir" />
@endif
