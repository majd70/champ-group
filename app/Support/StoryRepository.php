<?php

namespace App\Support;

use Illuminate\Support\Facades\Config;

/**
 * Resolves the file-driven story content (config/stories.php) into a
 * locale-flattened, ordered payload consumed by both the Blade tray and
 * the JSON endpoint.
 *
 * - Bilingual fields (['ar' => ..., 'en' => ...]) collapse to the active locale.
 * - Stories are returned newest -> oldest by `published_at`.
 * - Slides are ordered by their explicit `sort` field.
 * - A short `version` hash per story lets the client invalidate "seen" state
 *   in localStorage whenever the story's content changes.
 */
class StoryRepository
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function all(?string $locale = null): array
    {
        $locale = $locale ?: app()->getLocale();
        $fallback = config('app.fallback_locale', 'en');

        $stories = Config::get('stories.stories', []);

        $resolved = array_map(
            fn (array $story) => self::resolveStory($story, $locale, $fallback),
            $stories
        );

        // newest first
        usort($resolved, fn ($a, $b) => strcmp($b['published_at'], $a['published_at']));

        return $resolved;
    }

    private static function resolveStory(array $story, string $locale, string $fallback): array
    {
        $slides = $story['slides'] ?? [];

        // order slides by explicit sort
        usort($slides, fn ($a, $b) => ($a['sort'] ?? 0) <=> ($b['sort'] ?? 0));

        $slides = array_values(array_map(
            fn (array $slide, int $i) => self::resolveSlide($slide, $i, $locale, $fallback),
            $slides,
            array_keys($slides)
        ));

        // Tray thumbnail = the first slide's first image (Instagram-style cover).
        $firstMedia = $slides[0]['media'][0]['url'] ?? null;

        return [
            'id'           => $story['id'],
            'label'        => self::pick($story['label'] ?? '', $locale, $fallback),
            'cover_image'  => self::url($story['cover_image'] ?? ''),
            'thumb'        => $firstMedia ?: self::url($story['cover_image'] ?? ''),
            'badge'        => isset($story['badge']) && $story['badge'] !== null
                ? self::pick($story['badge'], $locale, $fallback)
                : null,
            'published_at' => $story['published_at'] ?? '',
            'accent'       => $story['accent'] ?? '#F4B81E',
            'version'      => self::version($story),
            'slides'       => $slides,
        ];
    }

    private static function resolveSlide(array $slide, int $index, string $locale, string $fallback): array
    {
        $media = array_map(function (array $m) {
            return [
                'type' => $m['type'] ?? 'image',
                'url'  => self::url($m['url'] ?? ''),
                'fit'  => $m['fit'] ?? 'cover',
            ];
        }, $slide['media'] ?? []);

        $blocks = array_map(function (array $b) use ($locale, $fallback) {
            return [
                'content'   => self::pick($b['content'] ?? '', $locale, $fallback),
                'style'     => $b['style'] ?? 'body',
                'animation' => [
                    'mode'   => $b['animation']['mode'] ?? 'line_by_line',
                    'delay'  => (int) ($b['animation']['delay'] ?? 0),
                    'speed'  => (int) ($b['animation']['speed'] ?? 400),
                    'easing' => $b['animation']['easing'] ?? 'ease-out',
                ],
            ];
        }, $slide['text_blocks'] ?? []);

        $cta = null;
        if (! empty($slide['cta'])) {
            $cta = [
                'label' => self::pick($slide['cta']['label'] ?? '', $locale, $fallback),
                'url'   => $slide['cta']['url'] ?? '#',
            ];
        }

        return [
            'sort'        => $slide['sort'] ?? ($index + 1),
            'duration'    => (int) ($slide['duration'] ?? 5000),
            'background'  => $slide['background'] ?? '#0A1330',
            'media'       => $media,
            'text_blocks' => $blocks,
            'cta'         => $cta,
        ];
    }

    /**
     * Resolve a media path: absolute URLs (http/https/protocol-relative or
     * data:) pass through untouched; everything else resolves via asset().
     */
    private static function url(string $path): string
    {
        if ($path === '') {
            return '';
        }

        if (preg_match('#^(https?:)?//#i', $path) || str_starts_with($path, 'data:')) {
            return $path;
        }

        return asset($path);
    }

    /**
     * Collapse a bilingual ['ar' => , 'en' => ] value to the active locale,
     * falling back gracefully. Plain strings pass through unchanged.
     */
    private static function pick($value, string $locale, string $fallback): string
    {
        if (is_array($value)) {
            return (string) ($value[$locale] ?? $value[$fallback] ?? reset($value) ?? '');
        }

        return (string) $value;
    }

    /**
     * Stable short hash of the raw story content used to bust client-side
     * "seen" state when the story changes.
     */
    private static function version(array $story): string
    {
        return substr(md5(json_encode([
            $story['published_at'] ?? '',
            count($story['slides'] ?? []),
            array_sum(array_map(fn ($s) => count($s['text_blocks'] ?? []) + count($s['media'] ?? []), $story['slides'] ?? [])),
        ])), 0, 8);
    }
}
