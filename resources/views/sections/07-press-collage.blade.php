<section
    id="page-07"
    class="relative w-full bg-[#06143A]"
    aria-labelledby="press-title"
>
    <h2 id="press-title" class="sr-only">{{ __('sections.achievements_a11y') }}</h2>

    <div class="py-16 md:py-20 lg:py-24">
        @php
            $achievementImages = [
                ['src' => 'https://picsum.photos/seed/ach-01/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-02/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-03/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-04/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-05/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-06/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-07/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-08/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-09/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-10/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-11/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-12/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-13/700/520'],
                ['src' => 'https://picsum.photos/seed/ach-14/700/520'],
            ];
        @endphp

        <x-marquee-gallery
            id="press-marquee"
            :eyebrow="__('sections.achievements_eyebrow')"
            :title="__('sections.achievements_title')"
            :subtitle="__('sections.achievements_subtitle')"
            :images="$achievementImages"
            speed="65s"
        />

        <div class="mx-auto mt-12 w-full max-w-[1440px] px-6 md:px-12">
            <x-page-footer index="07" total="12" :label="__('sections.footer_07')" />
        </div>
    </div>
</section>
