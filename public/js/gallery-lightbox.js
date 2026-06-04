/*
 * Champions Group — Achievements Gallery lightbox
 * Self-contained: scans the DOM for [data-gallery-root] containers,
 * wires each one to a single shared lightbox modal that supports
 * prev/next arrows, keyboard nav (← → Esc), swipe on touch devices,
 * a slide counter, and fade transitions.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', init);

    function init() {
        const roots = document.querySelectorAll('[data-gallery-root]');
        if (!roots.length) return;

        // Build a single shared modal at the end of <body>
        const modal = buildModal();
        document.body.appendChild(modal.root);

        // State
        let activeItems = [];
        let activeIndex = 0;

        // Wire each gallery
        roots.forEach((root) => {
            const items = Array.from(root.querySelectorAll('[data-gallery-item]'));
            items.forEach((btn, idx) => {
                btn.addEventListener('click', () => {
                    activeItems = items.map((el) => ({
                        src: el.dataset.src,
                        title: el.dataset.title || '',
                        year: el.dataset.year || '',
                    }));
                    activeIndex = idx;
                    open();
                });
            });
        });

        function open() {
            render();
            modal.root.classList.add('is-open');
            modal.root.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            // focus the close button for keyboard users
            requestAnimationFrame(() => modal.closeBtn.focus());
        }

        function close() {
            modal.root.classList.remove('is-open');
            modal.root.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        function next() {
            activeIndex = (activeIndex + 1) % activeItems.length;
            render();
        }

        function prev() {
            activeIndex = (activeIndex - 1 + activeItems.length) % activeItems.length;
            render();
        }

        function render() {
            const item = activeItems[activeIndex];
            if (!item) return;

            // Fade swap
            modal.img.classList.add('is-fading');
            const tmp = new Image();
            tmp.onload = tmp.onerror = () => {
                modal.img.src = item.src;
                modal.img.alt = item.title || '';
                modal.title.textContent = item.title || '';
                modal.year.textContent = item.year || '';
                modal.counter.textContent = (activeIndex + 1) + ' / ' + activeItems.length;
                requestAnimationFrame(() => modal.img.classList.remove('is-fading'));
            };
            tmp.src = item.src;
        }

        // Keyboard
        document.addEventListener('keydown', (e) => {
            if (!modal.root.classList.contains('is-open')) return;
            if (e.key === 'Escape') close();
            else if (e.key === 'ArrowRight') next();
            else if (e.key === 'ArrowLeft') prev();
        });

        // Close handlers
        modal.closeBtn.addEventListener('click', close);
        modal.backdrop.addEventListener('click', close);
        modal.nextBtn.addEventListener('click', next);
        modal.prevBtn.addEventListener('click', prev);

        // Swipe on touch
        let touchStartX = 0;
        let touchEndX = 0;
        modal.stage.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].clientX;
        }, { passive: true });
        modal.stage.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].clientX;
            const delta = touchEndX - touchStartX;
            if (Math.abs(delta) < 50) return;
            if (delta < 0) next();
            else prev();
        }, { passive: true });
    }

    function buildModal() {
        const root = document.createElement('div');
        root.className = 'gallery-lightbox';
        root.setAttribute('role', 'dialog');
        root.setAttribute('aria-modal', 'true');
        root.setAttribute('aria-label', 'Image gallery');
        root.setAttribute('aria-hidden', 'true');

        root.innerHTML = `
            <div class="gallery-lightbox__backdrop" data-backdrop></div>

            <button type="button" class="gallery-lightbox__close" aria-label="Close gallery" data-close>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <button type="button" class="gallery-lightbox__nav gallery-lightbox__nav--prev" aria-label="Previous image" data-prev>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <button type="button" class="gallery-lightbox__nav gallery-lightbox__nav--next" aria-label="Next image" data-next>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>

            <div class="gallery-lightbox__stage" data-stage>
                <img class="gallery-lightbox__img" alt="" />
            </div>

            <div class="gallery-lightbox__caption">
                <div class="gallery-lightbox__title" data-title></div>
                <div class="gallery-lightbox__year" data-year></div>
            </div>

            <div class="gallery-lightbox__counter" data-counter></div>
        `;

        return {
            root,
            backdrop:  root.querySelector('[data-backdrop]'),
            closeBtn:  root.querySelector('[data-close]'),
            prevBtn:   root.querySelector('[data-prev]'),
            nextBtn:   root.querySelector('[data-next]'),
            stage:     root.querySelector('[data-stage]'),
            img:       root.querySelector('.gallery-lightbox__img'),
            title:     root.querySelector('[data-title]'),
            year:      root.querySelector('[data-year]'),
            counter:   root.querySelector('[data-counter]'),
        };
    }
})();
