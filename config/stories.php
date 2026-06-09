<?php

/*
|--------------------------------------------------------------------------
| Stories (Instagram-style highlights) — content source
|--------------------------------------------------------------------------
|
| This site has no content database; the whole site is file/config driven
| (see config/partner_logos.php + the lang/* files). Stories follow the
| same pattern: one entry per Champions sub-brand (Hub, Egytal Hub, LMS,
| Club, Al Jalaa', Academy). Slide TEXT is bilingual (ar/en) and resolved
| to the active locale by App\Support\StoryRepository.
|
| NAMES: the partner/brand name (`label` + the brand-name headline) is a
| plain English string on purpose — it stays English even on the Arabic
| site (per request). Descriptive body text stays bilingual.
|
| MEDIA: demo/trial photos (picsum.photos, same source already used by the
| Al Jalaa' section). Absolute URLs are passed through untouched; relative
| paths resolve via asset(). Swap freely later.
|
| Ordering is by `published_at` DESC (newest first), spanning 2015 -> 2026.
| Slides are ordered by their explicit `sort` field.
|
| text_blocks[].animation.mode: 'word_by_word' | 'line_by_line' | 'typewriter'
|   (typewriter auto-falls back to word_by_word for Arabic to preserve shaping)
| text_blocks[].style:           'eyebrow' | 'headline' | 'body' | 'stat'
|
*/

return [

    'stories' => [

        /* ===== Champions Hub — newest ===================================== */
        [
            'id'           => 'hub',
            'label'        => 'Champions Hub',
            'cover_image'  => 'images/page-04/shield.png',
            'badge'        => ['ar' => 'جديد', 'en' => 'New'],
            'published_at' => '2026-02-01',
            'accent'       => '#F4B81E',
            'slides'       => [
                [
                    'sort'       => 1,
                    'duration'   => 6000,
                    'background' => '#0A1330',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-hub-1/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'eyebrow',  'content' => ['ar' => 'منصة متكاملة', 'en' => 'Integrated Platform'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 200, 'speed' => 500, 'easing' => 'ease-out']],
                        ['style' => 'headline', 'content' => 'Champions Hub',
                            'animation' => ['mode' => 'word_by_word', 'delay' => 550, 'speed' => 130, 'easing' => 'ease-out']],
                        ['style' => 'body',     'content' => ['ar' => 'عصر جديد من تطوير الرياضة الشامل — يجمع التعليم والتكنولوجيا من القاعدة إلى الاحتراف.', 'en' => 'A new era of all-in-one sports development — uniting education and technology from grassroots to professional.'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 1200, 'speed' => 500, 'easing' => 'ease-out']],
                    ],
                    'cta' => null,
                ],
                [
                    'sort'       => 2,
                    'duration'   => 6000,
                    'background' => '#06143A',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-hub-2/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'stat',    'content' => ['ar' => 'الكل في واحد', 'en' => 'All-In-One'],
                            'animation' => ['mode' => 'word_by_word', 'delay' => 300, 'speed' => 140, 'easing' => 'ease-out']],
                        ['style' => 'body',    'content' => ['ar' => 'تحليل الأداء · وصول مُدار · اعتمادات معترف بها عبر كل جانب من جوانب الرياضة.', 'en' => 'Performance analysis · managed access · recognized credentials across every aspect of sport.'],
                            'animation' => ['mode' => 'typewriter', 'delay' => 900, 'speed' => 28, 'easing' => 'linear']],
                    ],
                    'cta' => null,
                ],
                [
                    'sort'       => 3,
                    'duration'   => 5000,
                    'background' => '#0A1330',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-hub-3/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'headline', 'content' => ['ar' => 'منصة واحدة لكل الرياضة', 'en' => 'One platform for all of sport'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 250, 'speed' => 450, 'easing' => 'ease-out']],
                    ],
                    'cta' => ['label' => ['ar' => 'اكتشف المنصة', 'en' => 'Explore the platform'], 'url' => 'https://champions-hub.com/'],
                ],
            ],
        ],

        /* ===== Egytal Hub ================================================= */
        [
            'id'           => 'egytalhub',
            'label'        => 'Egytal Hub',
            'cover_image'  => 'images/page-11/logo.png',
            'badge'        => ['ar' => 'شريك', 'en' => 'Partner'],
            'published_at' => '2025-08-01',
            'accent'       => '#F4B81E',
            'slides'       => [
                [
                    'sort'       => 1,
                    'duration'   => 6000,
                    'background' => '#0A1330',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-egytal-1/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'eyebrow',  'content' => ['ar' => 'خدمات المواهب والتطوير', 'en' => 'Talent & LD Services'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 200, 'speed' => 500, 'easing' => 'ease-out']],
                        ['style' => 'headline', 'content' => 'Egytal Hub',
                            'animation' => ['mode' => 'word_by_word', 'delay' => 550, 'speed' => 130, 'easing' => 'ease-out']],
                        ['style' => 'body',     'content' => ['ar' => 'خدمات عن بُعد تربط الشركات العالمية بأفضل المواهب — تعزيز الكوادر وحلول المشاريع التقنية.', 'en' => 'Long-distance services connecting global companies with top talent — staff augmentation and IT project solutions.'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 1200, 'speed' => 500, 'easing' => 'ease-out']],
                    ],
                    'cta' => null,
                ],
                [
                    'sort'       => 2,
                    'duration'   => 5500,
                    'background' => '#06143A',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-egytal-2/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'stat',  'content' => ['ar' => 'رضا العملاء 95٪', 'en' => '95% Client Satisfaction'],
                            'animation' => ['mode' => 'word_by_word', 'delay' => 300, 'speed' => 150, 'easing' => 'ease-out']],
                        ['style' => 'body',  'content' => ['ar' => 'من التوظيف إلى تقارير الأداء — موهبة مصر، يتم تسليمها.', 'en' => "From recruitment to performance reporting — Egypt's talent, delivered."],
                            'animation' => ['mode' => 'word_by_word', 'delay' => 900, 'speed' => 90, 'easing' => 'ease-out']],
                    ],
                    'cta' => ['label' => ['ar' => 'تواصل معنا', 'en' => 'Get in touch'], 'url' => 'https://egytalhub.com/'],
                ],
            ],
        ],

        /* ===== Champions LMS ============================================= */
        [
            'id'           => 'lms',
            'label'        => 'Champions LMS',
            'cover_image'  => 'images/page-05/laptops.png',
            'badge'        => null,
            'published_at' => '2024-05-01',
            'accent'       => '#F4B81E',
            'slides'       => [
                [
                    'sort'       => 1,
                    'duration'   => 6000,
                    'background' => '#0A1330',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-lms-1/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'eyebrow',  'content' => ['ar' => 'منصة التعلم', 'en' => 'Learning Platform'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 200, 'speed' => 500, 'easing' => 'ease-out']],
                        ['style' => 'headline', 'content' => ['ar' => 'مصممة لكل متعلم', 'en' => 'Built for every learner'],
                            'animation' => ['mode' => 'word_by_word', 'delay' => 550, 'speed' => 130, 'easing' => 'ease-out']],
                        ['style' => 'body',     'content' => ['ar' => 'منصة تعلم متعددة المستأجرين — توجيه مدعوم بالذكاء الاصطناعي وتعلم تفاعلي وبث مباشر وعلامة بيضاء كاملة.', 'en' => 'A multi-tenant learning platform — AI-powered mentoring, interactive learning, live streaming and full white-label branding.'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 1200, 'speed' => 500, 'easing' => 'ease-out']],
                    ],
                    'cta' => null,
                ],
                [
                    'sort'       => 2,
                    'duration'   => 5000,
                    'background' => '#06143A',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-lms-2/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'headline', 'content' => ['ar' => 'تعلّم. درّب. تطوّر.', 'en' => 'Learn. Train. Grow.'],
                            'animation' => ['mode' => 'word_by_word', 'delay' => 250, 'speed' => 220, 'easing' => 'ease-out']],
                    ],
                    'cta' => ['label' => ['ar' => 'جرّب المنصة', 'en' => 'Try the platform'], 'url' => 'https://champions-lms.com/'],
                ],
            ],
        ],

        /* ===== Champions Club ============================================ */
        [
            'id'           => 'club',
            'label'        => 'Champions Club',
            'cover_image'  => 'images/page-08/shield.png',
            'badge'        => null,
            'published_at' => '2023-10-01',
            'accent'       => '#F4B81E',
            'slides'       => [
                [
                    'sort'       => 1,
                    'duration'   => 6000,
                    'background' => '#0A1330',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-club-1/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'eyebrow',  'content' => ['ar' => '2018 · 2023', 'en' => '2018 · 2023'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 200, 'speed' => 500, 'easing' => 'ease-out']],
                        ['style' => 'headline', 'content' => ['ar' => 'ملاذ عائلي', 'en' => 'A family sanctuary'],
                            'animation' => ['mode' => 'word_by_word', 'delay' => 550, 'speed' => 140, 'easing' => 'ease-out']],
                        ['style' => 'body',     'content' => ['ar' => 'ملاذ بمساحة 24,000 م² تأسس 2018 كأول نادٍ عائلي من نوعه في فلسطين.', 'en' => 'A 24,000 m² sanctuary founded in 2018 as the first family club of its kind in Palestine.'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 1200, 'speed' => 500, 'easing' => 'ease-out']],
                    ],
                    'cta' => null,
                ],
                [
                    'sort'       => 2,
                    'duration'   => 6500,
                    'background' => '#06143A',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-club-2/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'stat',  'content' => ['ar' => '24,000 م²', 'en' => '24,000 m²'],
                            'animation' => ['mode' => 'word_by_word', 'delay' => 300, 'speed' => 160, 'easing' => 'ease-out']],
                        ['style' => 'body',  'content' => ['ar' => 'حرم عائلي متعدد الأغراض · أكثر من 20 معرضاً تجارياً سنوياً. دُمّر بالكامل في حرب أكتوبر 2023.', 'en' => 'Multi-purpose family campus · 20+ commercial exhibitions yearly. Completely destroyed in the October 2023 war.'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 900, 'speed' => 550, 'easing' => 'ease-out']],
                    ],
                    'cta' => ['label' => ['ar' => 'قصة النادي', 'en' => 'The club story'], 'url' => '#page-08'],
                ],
            ],
        ],

        /* ===== Al Jalaa' ================================================= */
        [
            'id'           => 'jalaa',
            'label'        => 'Al Jalaa',
            'cover_image'  => 'images/page-10/shield.png',
            'badge'        => ['ar' => 'غير ربحي', 'en' => 'Non-profit'],
            'published_at' => '2022-06-01',
            'accent'       => '#F4B81E',
            'slides'       => [
                [
                    'sort'       => 1,
                    'duration'   => 6000,
                    'background' => '#0A1330',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-jalaa-1/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'eyebrow',  'content' => ['ar' => 'تأسس 1992 · استحوذ 2022 · غزة', 'en' => 'Founded 1992 · Acquired 2022 · Gaza'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 200, 'speed' => 500, 'easing' => 'ease-out']],
                        ['style' => 'headline', 'content' => 'Al Jalaa',
                            'animation' => ['mode' => 'word_by_word', 'delay' => 550, 'speed' => 150, 'easing' => 'ease-out']],
                        ['style' => 'body',     'content' => ['ar' => 'أحد أقدم الأندية الرياضية في غزة — يخدم جميع الأعمار والأجناس. استحوذت عليه مجموعة تشامبيونز عام 2022.', 'en' => "One of Gaza's oldest sports clubs — serving all ages and genders. Acquired by Champions Group in 2022."],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 1200, 'speed' => 500, 'easing' => 'ease-out']],
                    ],
                    'cta' => null,
                ],
                [
                    'sort'       => 2,
                    'duration'   => 6000,
                    'background' => '#06143A',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-jalaa-2/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'stat',  'content' => ['ar' => 'منذ 1992', 'en' => 'Since 1992'],
                            'animation' => ['mode' => 'word_by_word', 'delay' => 300, 'speed' => 170, 'easing' => 'ease-out']],
                        ['style' => 'body',  'content' => ['ar' => 'الطموح: الفوز بالدوري الفلسطيني والمنافسة دولياً.', 'en' => 'The ambition: win the Palestinian league and compete internationally.'],
                            'animation' => ['mode' => 'word_by_word', 'delay' => 900, 'speed' => 95, 'easing' => 'ease-out']],
                    ],
                    'cta' => ['label' => ['ar' => 'تعرّف على الجلاء', 'en' => 'Discover Al Jalaa'], 'url' => '#page-10'],
                ],
            ],
        ],

        /* ===== Champions Academy — oldest =============================== */
        [
            'id'           => 'academy',
            'label'        => 'Champions Academy',
            'cover_image'  => 'images/page-06/shield.png',
            'badge'        => null,
            'published_at' => '2015-01-01',
            'accent'       => '#F4B81E',
            'slides'       => [
                [
                    'sort'       => 1,
                    'duration'   => 6000,
                    'background' => '#0A1330',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-academy-1/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'eyebrow',  'content' => ['ar' => 'تأسست 2015', 'en' => 'Founded 2015'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 200, 'speed' => 500, 'easing' => 'ease-out']],
                        ['style' => 'headline', 'content' => 'Champions Academy',
                            'animation' => ['mode' => 'word_by_word', 'delay' => 550, 'speed' => 130, 'easing' => 'ease-out']],
                        ['style' => 'body',     'content' => ['ar' => 'تنشئة أجيال قادرة على المنافسة دولياً عبر تسع أكاديميات رياضية.', 'en' => 'Cultivating generations to compete internationally across nine sports academies.'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 1200, 'speed' => 500, 'easing' => 'ease-out']],
                    ],
                    'cta' => null,
                ],
                [
                    'sort'       => 2,
                    'duration'   => 5500,
                    'background' => '#06143A',
                    'media'      => [['type' => 'image', 'url' => 'https://picsum.photos/seed/cg-academy-2/900/1600', 'fit' => 'cover']],
                    'text_blocks' => [
                        ['style' => 'stat',  'content' => ['ar' => '8,000 لاعب', 'en' => '8,000 players'],
                            'animation' => ['mode' => 'word_by_word', 'delay' => 300, 'speed' => 150, 'easing' => 'ease-out']],
                        ['style' => 'body',  'content' => ['ar' => '5,600 ذكور · 2,400 إناث · كرة قدم وسلة وتنس وسباحة وكاراتيه والمزيد.', 'en' => '5,600 male · 2,400 female · football, basketball, tennis, swimming, karate and more.'],
                            'animation' => ['mode' => 'line_by_line', 'delay' => 900, 'speed' => 500, 'easing' => 'ease-out']],
                    ],
                    'cta' => ['label' => ['ar' => 'انضم للأكاديمية', 'en' => 'Join the academy'], 'url' => 'https://champions-academies.com/'],
                ],
            ],
        ],

    ],
];
