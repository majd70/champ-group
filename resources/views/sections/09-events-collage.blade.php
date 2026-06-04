<section
    id="page-09"
    class="relative w-full bg-[#06143A]"
    aria-labelledby="events-title"
>
    <h2 id="events-title" class="sr-only">{{ __('sections.events_gallery_a11y') }}</h2>

    <div class="py-16 md:py-20 lg:py-24">
        @php
            $eventImages = [
                ['src' => 'https://picsum.photos/seed/evt-01/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-02/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-03/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-04/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-05/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-06/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-07/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-08/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-09/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-10/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-11/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-12/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-13/700/520'],
                ['src' => 'https://picsum.photos/seed/evt-14/700/520'],
            ];
        @endphp

        <x-marquee-gallery
            id="events-marquee"
            :eyebrow="__('sections.events_gallery_eyebrow')"
            :title="__('sections.events_gallery_title')"
            :subtitle="__('sections.events_gallery_subtitle')"
            :images="$eventImages"
            speed="70s"
        />

        <div class="mx-auto mt-12 w-full max-w-[1440px] px-6 md:px-12">
            <x-page-footer index="09" total="12" :label="__('sections.footer_09')" />
        </div>
    </div>
</section>
