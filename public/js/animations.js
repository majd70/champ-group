/*
 * Champions Group — scroll animations via GSAP + ScrollTrigger
 * Runs after gsap.min.js and ScrollTrigger.min.js have loaded.
 * If those globals are missing OR the user prefers reduced motion,
 * the script exits without touching the DOM (so the page renders
 * normally without animation).
 */
(function () {
    'use strict';

    if (typeof window.gsap === 'undefined' || typeof window.ScrollTrigger === 'undefined') {
        return;
    }
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    gsap.registerPlugin(ScrollTrigger);
    gsap.defaults({ ease: 'power3.out', duration: 0.8 });

    // =====================================================================
    // STAT COUNTERS — count from 0 up to the displayed value on scroll
    // =====================================================================
    function parseStat(text) {
        const trimmed = text.trim();
        // matches: optional +/- prefix, digit run (may contain commas), trailing text
        const match = trimmed.match(/^([+\-]?)([\d,]+)(.*)$/);
        if (!match) return null;

        const numericStr = match[2];
        const target = parseInt(numericStr.replace(/,/g, ''), 10);
        if (isNaN(target) || target < 5) return null;

        const suffix = match[3] || '';
        // skip ratio-style stats like 24/7
        if (suffix.includes('/')) return null;

        return {
            prefix: match[1] || '',
            target,
            suffix,
            hasComma: numericStr.includes(','),
        };
    }

    function formatNumber(value, hasComma) {
        const rounded = Math.round(value);
        return hasComma ? rounded.toLocaleString('en-US') : String(rounded);
    }

    document.querySelectorAll('.stat-counter').forEach(function (el) {
        const finalText = el.textContent;
        const parsed = parseStat(finalText);
        if (!parsed) return;

        const { prefix, target, suffix, hasComma } = parsed;
        const counter = { val: 0 };

        // show 0 initially so the count-up animation reads correctly
        el.textContent = prefix + '0' + suffix;
        el.style.willChange = 'contents';

        ScrollTrigger.create({
            trigger: el,
            start: 'top 85%',
            once: true,
            onEnter: function () {
                gsap.to(counter, {
                    val: target,
                    duration: Math.min(2.4, 0.8 + Math.log10(target + 1) * 0.55),
                    ease: 'power2.out',
                    onUpdate: function () {
                        el.textContent = prefix + formatNumber(counter.val, hasComma) + suffix;
                    },
                    onComplete: function () {
                        // snap to the exact original text so formatting matches perfectly
                        el.textContent = finalText;
                        el.style.willChange = 'auto';
                    },
                });
            },
        });
    });

    // =====================================================================
    // HERO (page 01) — runs on page load, not scroll
    // =====================================================================
    const hero = document.getElementById('page-01');
    if (hero) {
        const tl = gsap.timeline({ defaults: { ease: 'power4.out' } });

        const eyebrow = hero.querySelector('.js-hero-eyebrow');
        const titleLines = hero.querySelectorAll('.js-hero-title-line');
        const shield = hero.querySelector('.js-hero-shield');
        const desc = hero.querySelector('.js-hero-desc');
        const stats = hero.querySelectorAll('.js-hero-stat');
        const rail = hero.querySelector('.js-hero-rail');

        if (eyebrow) tl.from(eyebrow, { opacity: 0, y: -8, duration: 0.6 }, 0);
        if (titleLines.length) tl.from(titleLines, { opacity: 0, y: 70, duration: 1.1, stagger: 0.18 }, 0.15);
        if (shield) tl.from(shield, { opacity: 0, scale: 0.7, duration: 1.1, ease: 'power3.out' }, 0.25);
        if (desc) tl.from(desc, { opacity: 0, y: 20, duration: 0.7 }, 0.7);
        if (stats.length) tl.from(stats, { opacity: 0, y: 20, duration: 0.55, stagger: 0.07 }, 0.9);
        if (rail) tl.from(rail, { opacity: 0, duration: 1.2 }, 0.6);
    }

    // =====================================================================
    // GENERIC FADE-UP — section eyebrows, titles, descriptions, dividers
    // =====================================================================
    function makeFadeUp(elements, options) {
        options = options || {};
        elements.forEach(function (el) {
            if (!el) return;
            gsap.from(el, {
                opacity: 0,
                y: options.y != null ? options.y : 30,
                duration: options.duration || 0.85,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: options.start || 'top 85%',
                    toggleActions: 'play none none reverse',
                },
            });
        });
    }

    // For pages 02+ (skip page-01, already handled in the timeline above)
    const otherSections = Array.from(document.querySelectorAll('section[id^="page-"]'))
        .filter(function (s) { return s.id !== 'page-01'; });

    otherSections.forEach(function (section) {
        const h2 = section.querySelector('h2');
        const firstEyebrow = section.querySelector(':scope > div > .text-eyebrow, :scope > div > :first-child > .text-eyebrow');
        const desc = section.querySelector(':scope > div > p, :scope > div > div > p:not(.js-no-anim)');

        if (firstEyebrow) makeFadeUp([firstEyebrow], { y: 14, duration: 0.6 });
        if (h2) makeFadeUp([h2], { y: 40, duration: 0.95 });
        if (desc) makeFadeUp([desc], { y: 20, duration: 0.7 });
    });

    // =====================================================================
    // SERVICE TILES (page 03) — stagger fade-up across the 3x3 grid
    // =====================================================================
    const servicesSection = document.getElementById('page-03');
    if (servicesSection) {
        const tiles = servicesSection.querySelectorAll('article');
        if (tiles.length) {
            gsap.from(tiles, {
                opacity: 0,
                y: 30,
                scale: 0.96,
                duration: 0.6,
                ease: 'power3.out',
                stagger: { each: 0.07, grid: [3, 3], from: 'start' },
                scrollTrigger: {
                    trigger: servicesSection.querySelector('.grid:has(article), .grid'),
                    start: 'top 80%',
                    toggleActions: 'play none none reverse',
                },
            });
        }
    }

    // =====================================================================
    // CROPPED IMAGE BLOCKS — partner grids, screenshots, collages
    // Each one fades up as a whole image since they were cropped as single
    // assets from the source PDF.
    // =====================================================================
    const imageSelectors = [
        '#page-02 img',
        '#page-04 img',
        '#page-05 img',
        '#page-06 img',
        '#page-07 img',
        '#page-08 img',
        '#page-09 img',
        '#page-10 img',
        '#page-11 img',
    ];

    imageSelectors.forEach(function (selector) {
        document.querySelectorAll(selector).forEach(function (img) {
            gsap.from(img, {
                opacity: 0,
                y: 30,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: img,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse',
                },
            });
        });
    });

    // =====================================================================
    // STAT GRIDS — stagger fade-up for the 6-stat blocks on pages 4/6/8/10/11
    // The count-up animation still fires per-element via .stat-counter above.
    // =====================================================================
    const statSectionIds = ['page-04', 'page-05', 'page-06', 'page-08', 'page-10', 'page-11'];
    statSectionIds.forEach(function (id) {
        const section = document.getElementById(id);
        if (!section) return;

        // Find the 6-stat grid: a grid container holding stat cells
        const grids = section.querySelectorAll('.grid');
        grids.forEach(function (grid) {
            // only target grids that look like stat grids (3 columns, multiple children)
            const children = grid.children;
            if (children.length < 3 || children.length > 9) return;
            // heuristic: first child should contain a gold-colored number span
            const first = children[0];
            if (!first || !first.querySelector('span[style*="font-family"]')) return;

            gsap.from(children, {
                opacity: 0,
                y: 25,
                duration: 0.55,
                ease: 'power3.out',
                stagger: 0.06,
                scrollTrigger: {
                    trigger: grid,
                    start: 'top 82%',
                    toggleActions: 'play none none reverse',
                },
            });
        });
    });

    // =====================================================================
    // FOOTER — stagger columns and social icons
    // =====================================================================
    const footer = document.getElementById('footer');
    if (footer) {
        const cols = footer.querySelectorAll(':scope > div > .grid > div');
        if (cols.length) {
            gsap.from(cols, {
                opacity: 0,
                y: 30,
                duration: 0.7,
                ease: 'power3.out',
                stagger: 0.1,
                scrollTrigger: {
                    trigger: footer,
                    start: 'top 88%',
                    toggleActions: 'play none none reverse',
                },
            });
        }

        const socialIcons = footer.querySelectorAll('a[aria-label="Facebook"], a[aria-label="Instagram"], a[aria-label="LinkedIn"], a[aria-label="X (Twitter)"], a[aria-label="YouTube"]');
        if (socialIcons.length) {
            gsap.from(socialIcons, {
                opacity: 0,
                scale: 0.6,
                duration: 0.5,
                ease: 'back.out(1.7)',
                stagger: 0.08,
                scrollTrigger: {
                    trigger: footer,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse',
                },
            });
        }
    }
})();
