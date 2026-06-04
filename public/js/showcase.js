/*
 * Champions Group — Achievements Showcase carousel
 * Cinematic single-slide hero with crossfade transitions, autoplay,
 * pause-on-hover, prev/next arrows, keyboard nav, swipe, and a
 * thumbnail strip that drives the active slide.
 *
 * Each instance is a [data-showcase] container with:
 *   [data-showcase-stage]    — slide stage
 *   .showcase-slide[data-slide=N]
 *   [data-showcase-prev] / [data-showcase-next]
 *   [data-showcase-thumbs] containing [data-showcase-thumb=N]
 *   [data-showcase-progress] — progress bar fill
 *   data-autoplay="ms"       — autoplay interval (0 to disable)
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-showcase]').forEach(initShowcase);
    });

    function initShowcase(root) {
        const slides   = Array.from(root.querySelectorAll('.showcase-slide'));
        const thumbs   = Array.from(root.querySelectorAll('[data-showcase-thumb]'));
        const prevBtn  = root.querySelector('[data-showcase-prev]');
        const nextBtn  = root.querySelector('[data-showcase-next]');
        const stage    = root.querySelector('[data-showcase-stage]');
        const progress = root.querySelector('[data-showcase-progress]');
        const total    = slides.length;
        if (!total) return;

        const autoplayMs = parseInt(root.dataset.autoplay, 10) || 0;
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        let current = 0;
        let timer = null;
        let progressRaf = null;
        let progressStart = 0;
        let isHovered = false;

        function setActive(next) {
            if (next === current) return;
            const prev = current;
            current = ((next % total) + total) % total;

            slides[prev].classList.remove('is-active');
            slides[prev].classList.add('opacity-0', 'z-0');
            slides[prev].classList.remove('opacity-100', 'z-10');
            slides[prev].setAttribute('aria-hidden', 'true');

            slides[current].classList.add('is-active');
            slides[current].classList.remove('opacity-0', 'z-0');
            slides[current].classList.add('opacity-100', 'z-10');
            slides[current].setAttribute('aria-hidden', 'false');

            thumbs.forEach((t, i) => {
                const active = i === current;
                t.classList.toggle('is-active', active);
                t.setAttribute('aria-selected', active ? 'true' : 'false');
                if (active) ensureThumbVisible(t);
            });

            restartProgress();
        }

        function next() { setActive(current + 1); }
        function prev() { setActive(current - 1); }

        function ensureThumbVisible(thumb) {
            const wrap = thumb.parentElement;
            if (!wrap) return;
            // Only scroll the thumb strip horizontally — never call scrollIntoView,
            // which can scroll the whole page vertically when the strip is off-screen.
            const target = thumb.offsetLeft - (wrap.clientWidth / 2) + (thumb.offsetWidth / 2);
            wrap.scrollTo({ left: Math.max(0, target), behavior: 'smooth' });
        }

        // --- Autoplay + progress -----------------------------------------
        function startTimer() {
            stopTimer();
            if (!autoplayMs || reduceMotion) return;
            timer = window.setTimeout(next, autoplayMs);
        }

        function stopTimer() {
            if (timer) { clearTimeout(timer); timer = null; }
        }

        function restartProgress() {
            if (!progress) { startTimer(); return; }
            if (progressRaf) cancelAnimationFrame(progressRaf);
            progress.style.width = '0%';
            if (!autoplayMs || reduceMotion || isHovered) { startTimer(); return; }
            progressStart = performance.now();
            const tick = (now) => {
                const elapsed = now - progressStart;
                const pct = Math.min(100, (elapsed / autoplayMs) * 100);
                progress.style.width = pct + '%';
                if (pct < 100 && !isHovered) {
                    progressRaf = requestAnimationFrame(tick);
                }
            };
            progressRaf = requestAnimationFrame(tick);
            startTimer();
        }

        function pause() {
            isHovered = true;
            stopTimer();
            if (progressRaf) cancelAnimationFrame(progressRaf);
        }
        function resume() {
            if (!isHovered) return;
            isHovered = false;
            restartProgress();
        }

        // --- Wiring ------------------------------------------------------
        if (prevBtn) prevBtn.addEventListener('click', () => { prev(); });
        if (nextBtn) nextBtn.addEventListener('click', () => { next(); });

        thumbs.forEach((t) => {
            t.addEventListener('click', () => setActive(parseInt(t.dataset.showcaseThumb, 10)));
        });

        // Hover pause
        root.addEventListener('mouseenter', pause);
        root.addEventListener('mouseleave', resume);

        // Keyboard (when stage is focused)
        if (stage) {
            stage.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight') { e.preventDefault(); next(); }
                else if (e.key === 'ArrowLeft') { e.preventDefault(); prev(); }
            });
        }

        // Touch swipe
        if (stage) {
            let startX = 0;
            let startY = 0;
            stage.addEventListener('touchstart', (e) => {
                startX = e.changedTouches[0].clientX;
                startY = e.changedTouches[0].clientY;
                pause();
            }, { passive: true });
            stage.addEventListener('touchend', (e) => {
                const dx = e.changedTouches[0].clientX - startX;
                const dy = e.changedTouches[0].clientY - startY;
                resume();
                if (Math.abs(dx) > 50 && Math.abs(dx) > Math.abs(dy)) {
                    if (dx < 0) next();
                    else prev();
                }
            }, { passive: true });
        }

        // Pause when tab is hidden (don't burn cycles)
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) pause();
            else resume();
        });

        // Kick off
        restartProgress();
    }
})();
