/*
 * Champions Group — Sticky Scroll Story
 * Each [data-sticky-story] section is tall (N * 90vh by default) with an
 * inner sticky stage that pins to the viewport. As the user scrolls through
 * the section, slides crossfade in sequence and the side dots / counter
 * update to reflect progress.
 *
 * Pure scroll-position driven (no IntersectionObserver) so the slide tracks
 * the scrollbar 1:1, with rAF batching to stay smooth.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', () => {
        const stories = document.querySelectorAll('[data-sticky-story]');
        if (!stories.length) return;

        stories.forEach(initStory);
    });

    function initStory(root) {
        const slides  = Array.from(root.querySelectorAll('[data-sticky-slide]'));
        const dots    = Array.from(root.querySelectorAll('[data-sticky-dot]'));
        const counter = root.querySelector('[data-sticky-counter]');
        const cue     = root.querySelector('[data-sticky-cue]');
        const total   = slides.length;
        if (!total) return;

        let currentIdx = 0;
        let rafQueued = false;

        function pickIndex() {
            const rect = root.getBoundingClientRect();
            const viewH = window.innerHeight;
            const sectionH = root.offsetHeight;
            // Scroll progress through the sticky region (0 = section top hits viewport top,
            // 1 = section bottom hits viewport bottom).
            const scrolled = -rect.top;
            const maxScroll = sectionH - viewH;
            if (maxScroll <= 0) return 0;
            const progress = Math.max(0, Math.min(1, scrolled / maxScroll));
            // Map progress to discrete slide indices.
            // Use a slightly-biased mapping so the *last* slide gets full screentime
            // before the section releases the sticky.
            const idx = Math.min(total - 1, Math.floor(progress * total));
            return idx;
        }

        function apply(idx) {
            if (idx === currentIdx) return;
            slides[currentIdx].classList.remove('is-active');
            slides[currentIdx].setAttribute('aria-hidden', 'true');
            slides[idx].classList.add('is-active');
            slides[idx].setAttribute('aria-hidden', 'false');
            if (dots[currentIdx]) dots[currentIdx].classList.remove('is-active');
            if (dots[idx]) dots[idx].classList.add('is-active');
            if (counter) counter.textContent = String(idx + 1).padStart(2, '0');
            currentIdx = idx;
        }

        function tick() {
            rafQueued = false;
            apply(pickIndex());
            // hide scroll cue once we've moved past the first slide
            if (cue) {
                if (currentIdx > 0) cue.classList.add('is-hidden');
                else                cue.classList.remove('is-hidden');
            }
        }

        function onScroll() {
            if (rafQueued) return;
            rafQueued = true;
            requestAnimationFrame(tick);
        }

        // Dot clicks scroll to the corresponding sub-range
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                const rect = root.getBoundingClientRect();
                const sectionTop = window.scrollY + rect.top;
                const sectionH = root.offsetHeight;
                const viewH = window.innerHeight;
                const maxScroll = sectionH - viewH;
                // Land slightly into slide i's range so apply() picks it.
                const targetProgress = (i + 0.4) / total;
                const targetScroll = sectionTop + targetProgress * maxScroll;
                window.scrollTo({ top: targetScroll, behavior: 'smooth' });
            });
        });

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll, { passive: true });
        tick();
    }
})();
