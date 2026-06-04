/*
 * Champions Group — 3D Coverflow carousel
 * Center image is large/forward; siblings are angled in 3D space with
 * progressive scale + opacity falloff. Auto-advances, pauses on hover,
 * click on a side card brings it to center, click on center opens lightbox.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-coverflow]').forEach(init);
    });

    function init(root) {
        const items   = Array.from(root.querySelectorAll('[data-coverflow-item]'));
        const dots    = Array.from(root.querySelectorAll('[data-coverflow-dot]'));
        const prevBtn = root.querySelector('[data-coverflow-prev]');
        const nextBtn = root.querySelector('[data-coverflow-next]');
        const counter = root.querySelector('[data-coverflow-counter]');
        const total   = items.length;
        if (!total) return;

        const autoplayMs = parseInt(root.dataset.autoplay, 10) || 0;
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        let current = 0;
        let timer = null;
        let isHovered = false;

        function layout() {
            items.forEach((item, i) => {
                let offset = i - current;
                // Shortest signed offset for an infinite-feeling loop
                if (offset > total / 2) offset -= total;
                if (offset < -total / 2) offset += total;

                const abs = Math.abs(offset);
                const dir = offset === 0 ? 0 : (offset > 0 ? 1 : -1);

                // Positioning math
                const translatePct = abs === 0 ? 0 : dir * (38 + (abs - 1) * 18);
                const rotateDeg    = -dir * Math.min(abs * 28, 55);
                const scale        = abs === 0 ? 1 : Math.max(0.45, 1 - abs * 0.18);
                const zIndex       = 30 - abs * 3;
                let opacity        = 1;
                if (abs === 1) opacity = 0.88;
                else if (abs === 2) opacity = 0.55;
                else if (abs >= 3) opacity = 0;

                item.style.transform = `translate(calc(-50% + ${translatePct}%), -50%) rotateY(${rotateDeg}deg) scale(${scale})`;
                item.style.opacity = String(opacity);
                item.style.zIndex = String(zIndex);
                item.style.pointerEvents = opacity === 0 ? 'none' : 'auto';
                item.classList.toggle('is-active', offset === 0);

                // Only the center item should open lightbox via [data-gallery-item];
                // side items should re-center instead.
                if (offset === 0) {
                    item.setAttribute('data-gallery-item', '');
                } else {
                    item.removeAttribute('data-gallery-item');
                }
            });

            dots.forEach((d, i) => d.classList.toggle('is-active', i === current));
            if (counter) counter.textContent = String(current + 1).padStart(2, '0');
        }

        function go(i) {
            current = ((i % total) + total) % total;
            layout();
            restartTimer();
        }

        function next() { go(current + 1); }
        function prev() { go(current - 1); }

        function startTimer() {
            stopTimer();
            if (!autoplayMs || reduceMotion || isHovered) return;
            timer = setInterval(next, autoplayMs);
        }
        function stopTimer() { if (timer) { clearInterval(timer); timer = null; } }
        function restartTimer() { startTimer(); }

        // Wire controls
        if (prevBtn) prevBtn.addEventListener('click', prev);
        if (nextBtn) nextBtn.addEventListener('click', next);
        dots.forEach((d, i) => d.addEventListener('click', () => go(i)));

        // Click on a side item brings it to center; center item is opened by
        // the gallery lightbox via its [data-gallery-item] hook (added in layout()).
        items.forEach((it, i) => {
            it.addEventListener('click', (e) => {
                if (i !== current) {
                    e.preventDefault();
                    e.stopPropagation();
                    go(i);
                }
            }, true);
        });

        // Hover pause
        root.addEventListener('mouseenter', () => { isHovered = true; stopTimer(); });
        root.addEventListener('mouseleave', () => { isHovered = false; startTimer(); });

        // Keyboard (when the carousel has focus)
        root.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') { e.preventDefault(); next(); }
            else if (e.key === 'ArrowLeft') { e.preventDefault(); prev(); }
        });

        // Touch swipe
        let startX = 0, startY = 0;
        root.addEventListener('touchstart', (e) => {
            startX = e.changedTouches[0].clientX;
            startY = e.changedTouches[0].clientY;
            stopTimer();
        }, { passive: true });
        root.addEventListener('touchend', (e) => {
            const dx = e.changedTouches[0].clientX - startX;
            const dy = e.changedTouches[0].clientY - startY;
            if (!isHovered) startTimer();
            if (Math.abs(dx) > 50 && Math.abs(dx) > Math.abs(dy)) {
                if (dx < 0) next();
                else prev();
            }
        }, { passive: true });

        // Pause when tab hidden
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) stopTimer();
            else if (!isHovered) startTimer();
        });

        layout();
        startTimer();
    }
})();
