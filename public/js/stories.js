/*
 * Champions Group — Instagram-style Stories
 * ------------------------------------------------------------------
 * Tray  : circular highlight bubbles (server-rendered). Marks seen/unseen
 *         from localStorage and opens the viewer.
 * Viewer: full-screen, auto-advancing multi-slide playback with progressive
 *         text reveal. All timing (slide progress + text reveal) is driven
 *         from a single pause-aware clock, so pause/resume and returning to a
 *         slide are flicker-free and never double-trigger.
 *
 * Data source: <script type="application/json" data-stories-data> emitted by
 * resources/views/components/stories/tray.blade.php (already locale-resolved
 * and ordered newest -> oldest by App\Support\StoryRepository).
 *
 * Pure vanilla, no build step — loaded directly from app.blade.php.
 */
(function () {
    'use strict';

    var SEEN_KEY = 'cg_stories_seen_v1';
    var IMG_DURATION_FALLBACK = 5000;

    document.addEventListener('DOMContentLoaded', function () {
        var dataEl = document.querySelector('[data-stories-data]');
        var viewerEl = document.querySelector('[data-stories-viewer]');
        if (!dataEl || !viewerEl) return;

        var stories;
        try {
            stories = JSON.parse(dataEl.textContent);
        } catch (e) {
            return;
        }
        if (!Array.isArray(stories) || !stories.length) return;

        var reducedMotion = window.matchMedia &&
            window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        var dir = viewerEl.getAttribute('data-dir') === 'rtl' ? 'rtl' : 'ltr';

        markTraySeen(stories);
        wireTray(stories, viewerEl, dir, reducedMotion);
    });

    /* ============================ TRAY ============================ */

    function readSeen() {
        try { return JSON.parse(localStorage.getItem(SEEN_KEY)) || {}; }
        catch (e) { return {}; }
    }

    function writeSeen(map) {
        try { localStorage.setItem(SEEN_KEY, JSON.stringify(map)); } catch (e) {}
    }

    function markTraySeen(stories) {
        var seen = readSeen();
        document.querySelectorAll('[data-story-open]').forEach(function (btn) {
            var id = btn.getAttribute('data-story-id');
            var version = btn.getAttribute('data-story-version');
            if (seen[id] && seen[id] === version) {
                btn.classList.add('is-seen');
            } else {
                btn.classList.remove('is-seen');
            }
        });
    }

    function setSeen(id, version) {
        var seen = readSeen();
        seen[id] = version;
        writeSeen(seen);
        var btn = document.querySelector('[data-story-open][data-story-id="' + id + '"]');
        if (btn) btn.classList.add('is-seen');
    }

    function wireTray(stories, viewerEl, dir, reducedMotion) {
        var viewer = new Viewer(viewerEl, stories, dir, reducedMotion);

        document.querySelectorAll('[data-story-open]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var id = btn.getAttribute('data-story-id');
                var idx = stories.findIndex(function (s) { return s.id === id; });
                if (idx < 0) idx = 0;
                viewer.open(idx, btn);
            });
        });
    }

    /* ============================ VIEWER ============================ */

    function Viewer(root, stories, dir, reducedMotion) {
        this.root = root;
        this.stories = stories;
        this.dir = dir;
        this.reduced = reducedMotion;

        this.canvas = root.querySelector('[data-stories-canvas]');
        this.progressWrap = root.querySelector('[data-stories-progress]');
        this.labelEl = root.querySelector('[data-stories-label]');
        this.dateEl = root.querySelector('[data-stories-date]');
        this.avatarImg = root.querySelector('[data-stories-avatar] img');
        this.muteBtn = root.querySelector('[data-stories-mute]');
        this.loadingEl = root.querySelector('[data-stories-loading]');

        this.storyIndex = 0;
        this.slideIndex = 0;
        this.playing = false;
        this.muted = true;
        this.rafId = null;
        this.lastTick = 0;
        this.elapsed = 0;          // ms accumulated in current slide while playing
        this.duration = IMG_DURATION_FALLBACK;
        this.segFills = [];
        this.blocks = [];          // { el, units[], mode, delay, speed, total, lastVisible }
        this.slideEl = null;
        this.video = null;
        this.opener = null;
        this.holdTimer = null;
        this.touch = null;

        this._bind();
    }

    Viewer.prototype._bind = function () {
        var self = this;

        this.root.querySelectorAll('[data-stories-close]').forEach(function (el) {
            el.addEventListener('click', function () { self.close(); });
        });

        var prev = this.root.querySelector('[data-stories-prev]');
        var next = this.root.querySelector('[data-stories-next]');
        // logical prev/next; physical sides are mirrored in CSS for RTL
        prev.addEventListener('click', function () { self.prevSlide(); });
        next.addEventListener('click', function () { self.nextSlide(); });

        if (this.muteBtn) {
            this.muteBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                self.toggleMute();
            });
        }

        // press & hold to pause (on the stage, not the controls)
        var stage = this.root.querySelector('[data-stories-stage]');
        var holdStart = function () {
            self.holdTimer = setTimeout(function () { self.pause(); }, 180);
        };
        var holdEnd = function () {
            clearTimeout(self.holdTimer);
            if (!self.playing && self.root.classList.contains('is-open')) self.resume();
        };
        stage.addEventListener('pointerdown', holdStart);
        stage.addEventListener('pointerup', holdEnd);
        stage.addEventListener('pointercancel', holdEnd);
        stage.addEventListener('pointerleave', function () { clearTimeout(self.holdTimer); });

        // swipe down to close
        stage.addEventListener('touchstart', function (e) {
            self.touch = { x: e.touches[0].clientX, y: e.touches[0].clientY };
        }, { passive: true });
        stage.addEventListener('touchend', function (e) {
            if (!self.touch) return;
            var dy = e.changedTouches[0].clientY - self.touch.y;
            var dx = Math.abs(e.changedTouches[0].clientX - self.touch.x);
            if (dy > 90 && dx < 80) self.close();
            self.touch = null;
        }, { passive: true });

        // keyboard
        this._onKey = function (e) {
            if (!self.root.classList.contains('is-open')) return;
            if (e.key === 'Escape') { self.close(); }
            else if (e.key === ' ') { e.preventDefault(); self.playing ? self.pause() : self.resume(); }
            else if (e.key === 'ArrowRight') { self.dir === 'rtl' ? self.prevSlide() : self.nextSlide(); }
            else if (e.key === 'ArrowLeft') { self.dir === 'rtl' ? self.nextSlide() : self.prevSlide(); }
            else if (e.key === 'Tab') { self._trapFocus(e); }
        };
        document.addEventListener('keydown', this._onKey);
    };

    Viewer.prototype.open = function (storyIndex, opener) {
        this.opener = opener || null;
        this.storyIndex = storyIndex;
        this.slideIndex = 0;
        this.root.hidden = false;
        // force reflow so the transition runs
        void this.root.offsetWidth;
        this.root.classList.add('is-open');
        this.root.setAttribute('aria-hidden', 'false');
        document.documentElement.style.overflow = 'hidden';
        this._goStory(storyIndex, 0);
        var closeBtn = this.root.querySelector('[data-stories-close].stories-viewer__ctrl');
        if (closeBtn) closeBtn.focus();
    };

    Viewer.prototype.close = function () {
        this._stopLoop();
        this._teardownSlide();
        this.root.classList.remove('is-open');
        this.root.setAttribute('aria-hidden', 'true');
        document.documentElement.style.overflow = '';
        var self = this;
        setTimeout(function () { if (!self.root.classList.contains('is-open')) self.root.hidden = true; }, 320);
        if (this.opener && typeof this.opener.focus === 'function') this.opener.focus();
    };

    Viewer.prototype._goStory = function (storyIndex, slideIndex) {
        if (storyIndex < 0) { return; }
        if (storyIndex >= this.stories.length) { this.close(); return; }

        this.storyIndex = storyIndex;
        this.slideIndex = slideIndex || 0;

        var story = this.stories[storyIndex];

        // header
        this.labelEl.textContent = story.label;
        this.dateEl.textContent = formatDate(story.published_at);
        this.avatarImg.src = story.cover_image;

        // mark seen
        setSeen(story.id, story.version);

        // build progress segments
        this._buildProgress(story.slides.length);

        this._renderSlide();
    };

    Viewer.prototype._buildProgress = function (count) {
        this.progressWrap.innerHTML = '';
        this.segFills = [];
        for (var i = 0; i < count; i++) {
            var seg = document.createElement('div');
            seg.className = 'stories-seg';
            seg.setAttribute('role', 'progressbar');
            var fill = document.createElement('span');
            fill.className = 'stories-seg__fill';
            seg.appendChild(fill);
            this.progressWrap.appendChild(seg);
            this.segFills.push(fill);
        }
    };

    Viewer.prototype._setSegments = function (currentProgress) {
        for (var i = 0; i < this.segFills.length; i++) {
            var p = i < this.slideIndex ? 1 : (i === this.slideIndex ? currentProgress : 0);
            this.segFills[i].style.transform = 'scaleX(' + p + ')';
        }
    };

    Viewer.prototype._renderSlide = function () {
        this._stopLoop();
        this._teardownSlide();

        var story = this.stories[this.storyIndex];
        var slide = story.slides[this.slideIndex];
        if (!slide) { this.nextSlide(); return; }

        this.elapsed = 0;
        this.duration = slide.duration || IMG_DURATION_FALLBACK;

        var el = document.createElement('div');
        el.className = 'stories-slide';
        el.style.background = slide.background || '#0A1330';

        // ---- media ----
        var mediaWrap = document.createElement('div');
        mediaWrap.className = 'stories-slide__media' + (slide.media.length > 1 ? ' is-multi' : '');
        var self = this;
        this.video = null;

        slide.media.forEach(function (m) {
            if (m.type === 'video') {
                var v = document.createElement('video');
                v.src = m.url;
                v.playsInline = true;
                v.muted = self.muted;
                v.preload = 'auto';
                v.className = 'stories-media is-' + (m.fit || 'cover');
                mediaWrap.appendChild(v);
                self.video = v;
            } else {
                var img = document.createElement('img');
                img.src = m.url;
                img.alt = '';
                img.draggable = false;
                img.className = 'stories-media is-' + (m.fit || 'cover');
                mediaWrap.appendChild(img);
            }
        });
        el.appendChild(mediaWrap);

        // scrim for legibility
        var scrim = document.createElement('div');
        scrim.className = 'stories-slide__scrim';
        el.appendChild(scrim);

        // ---- content (text blocks + cta) ----
        var content = document.createElement('div');
        content.className = 'stories-slide__content';
        this.blocks = [];

        (slide.text_blocks || []).forEach(function (b) {
            var block = self._buildBlock(b);
            content.appendChild(block.el);
            self.blocks.push(block);
        });

        if (slide.cta && slide.cta.label) {
            var a = document.createElement('a');
            a.className = 'stories-cta';
            a.href = slide.cta.url || '#';
            a.textContent = slide.cta.label;
            a.setAttribute('data-stories-cta', '');
            // external links open in a new tab so the site stays open behind the story
            if (/^(https?:)?\/\//i.test(a.getAttribute('href'))) {
                a.target = '_blank';
                a.rel = 'noopener noreferrer';
            }
            a.addEventListener('click', function () { self.close(); });
            content.appendChild(a);
            // reveal CTA after the last block's reveal finishes
            this._ctaEl = a;
        } else {
            this._ctaEl = null;
        }
        el.appendChild(content);

        this.canvas.appendChild(el);
        this.slideEl = el;

        this.muteBtn.hidden = !this.video;

        // preload neighbours
        this._preloadNeighbours();

        // start
        this._startSlide();
    };

    Viewer.prototype._buildBlock = function (b) {
        var el = document.createElement('div');
        el.className = 'stories-text stories-text--' + (b.style || 'body');
        var anim = b.animation || {};
        var mode = this.reduced ? 'none' : (anim.mode || 'line_by_line');
        var delay = anim.delay || 0;
        var speed = anim.speed || 400;
        if (anim.easing) el.style.setProperty('--ease', anim.easing);

        var units = [];
        var content = b.content || '';

        // Per-character (typewriter) splitting breaks Arabic letter joining and
        // bidi order — fall back to word-by-word for any Arabic content so the
        // script stays correctly shaped. Bump speed so it still reads as a flow.
        if (mode === 'typewriter' && isArabic(content)) {
            mode = 'word_by_word';
            speed = Math.max(speed * 4, 120);
        }

        if (mode === 'word_by_word') {
            content.split(/(\s+)/).forEach(function (tok) {
                if (tok.trim() === '') { el.appendChild(document.createTextNode(tok)); return; }
                var s = document.createElement('span');
                s.className = 'u-word';
                s.textContent = tok;
                el.appendChild(s);
                units.push(s);
            });
        } else if (mode === 'typewriter') {
            content.split('').forEach(function (ch) {
                var s = document.createElement('span');
                s.className = 'u-char';
                s.textContent = ch;
                el.appendChild(s);
                units.push(s);
            });
        } else if (mode === 'line_by_line') {
            content.split('\n').forEach(function (line) {
                var s = document.createElement('span');
                s.className = 'u-line';
                s.textContent = line;
                el.appendChild(s);
                units.push(s);
            });
        } else {
            // reduced motion / none: full text, no per-unit animation
            el.textContent = content;
        }

        return {
            el: el, units: units, mode: mode,
            delay: delay, speed: speed, total: units.length, lastVisible: -1,
        };
    };

    /* ---- pause-aware clock drives BOTH slide progress and text reveal ---- */

    Viewer.prototype._startSlide = function () {
        var self = this;
        this.playing = true;
        this.root.classList.remove('is-paused');

        var begin = function () {
            self.lastTick = now();
            self._loop();
            if (self.video) { var p = self.video.play(); if (p && p.catch) p.catch(function () {}); }
        };

        // wait for first media to be ready (so duration is right for video & no flash)
        if (this.video) {
            if (this.video.readyState >= 1) {
                if (this.video.duration && isFinite(this.video.duration)) {
                    this.duration = this.video.duration * 1000;
                }
                begin();
            } else {
                this._showLoading(true);
                this.video.addEventListener('loadedmetadata', function () {
                    self._showLoading(false);
                    if (self.video.duration && isFinite(self.video.duration)) {
                        self.duration = self.video.duration * 1000;
                    }
                    begin();
                }, { once: true });
            }
        } else {
            begin();
        }

        if (this.reduced) this._revealAll();
    };

    Viewer.prototype._loop = function () {
        var self = this;
        this.rafId = requestAnimationFrame(function () {
            var t = now();
            var dt = t - self.lastTick;
            self.lastTick = t;
            if (self.playing) self.elapsed += dt;

            var progress = Math.min(self.elapsed / self.duration, 1);
            self._setSegments(progress);
            if (!self.reduced) self._tickText();

            if (progress >= 1) { self.nextSlide(); return; }
            self._loop();
        });
    };

    Viewer.prototype._tickText = function () {
        for (var i = 0; i < this.blocks.length; i++) {
            var blk = this.blocks[i];
            if (!blk.units.length) continue;
            var local = this.elapsed - blk.delay;
            var visible;
            if (blk.mode === 'line_by_line') {
                visible = 0;
                for (var j = 0; j < blk.total; j++) {
                    if (local >= j * blk.speed) visible = j + 1;
                }
            } else {
                visible = local < 0 ? 0 : Math.floor(local / blk.speed) + 1;
            }
            if (visible > blk.total) visible = blk.total;
            if (visible === blk.lastVisible) continue;
            for (var k = 0; k < blk.total; k++) {
                if (k < visible) blk.units[k].classList.add('is-in');
                else blk.units[k].classList.remove('is-in');
            }
            blk.lastVisible = visible;
        }
        if (this._ctaEl) {
            // show CTA once ~70% of the slide has elapsed
            if (this.elapsed / this.duration >= 0.55) this._ctaEl.classList.add('is-in');
        }
    };

    Viewer.prototype._revealAll = function () {
        this.blocks.forEach(function (blk) {
            blk.units.forEach(function (u) { u.classList.add('is-in'); });
            blk.lastVisible = blk.total;
        });
        if (this._ctaEl) this._ctaEl.classList.add('is-in');
    };

    Viewer.prototype.pause = function () {
        if (!this.playing) return;
        this.playing = false;
        this.root.classList.add('is-paused');
        if (this.video) this.video.pause();
    };

    Viewer.prototype.resume = function () {
        if (this.playing || !this.root.classList.contains('is-open')) return;
        this.playing = true;
        this.lastTick = now();
        this.root.classList.remove('is-paused');
        if (this.video) { var p = this.video.play(); if (p && p.catch) p.catch(function () {}); }
    };

    Viewer.prototype.nextSlide = function () {
        var story = this.stories[this.storyIndex];
        if (this.slideIndex < story.slides.length - 1) {
            this.slideIndex++;
            this._renderSlide();
        } else {
            this._goStory(this.storyIndex + 1, 0);
        }
    };

    Viewer.prototype.prevSlide = function () {
        if (this.slideIndex > 0) {
            this.slideIndex--;
            this._renderSlide();
        } else if (this.storyIndex > 0) {
            this._goStory(this.storyIndex - 1, 0);
        } else {
            // restart current slide
            this._renderSlide();
        }
    };

    Viewer.prototype.toggleMute = function () {
        this.muted = !this.muted;
        if (this.video) this.video.muted = this.muted;
        this.muteBtn.setAttribute('aria-label', this.muted ? 'Unmute' : 'Mute');
        this.muteBtn.querySelectorAll('[data-icon-mute]').forEach(function (n) { n.hidden = !this.muted; }, this);
        this.muteBtn.querySelectorAll('[data-icon-unmute]').forEach(function (n) { n.hidden = this.muted; }, this);
    };

    Viewer.prototype._preloadNeighbours = function () {
        var targets = [];
        var story = this.stories[this.storyIndex];
        var nextInStory = story.slides[this.slideIndex + 1];
        if (nextInStory) targets.push(nextInStory);
        else {
            var ns = this.stories[this.storyIndex + 1];
            if (ns && ns.slides[0]) targets.push(ns.slides[0]);
        }
        targets.forEach(function (slide) {
            (slide.media || []).forEach(function (m) {
                if (m.type === 'video') {
                    var v = document.createElement('video');
                    v.preload = 'auto'; v.src = m.url;
                } else {
                    var im = new Image(); im.src = m.url;
                }
            });
        });
    };

    Viewer.prototype._showLoading = function (on) {
        if (this.loadingEl) this.loadingEl.setAttribute('aria-hidden', on ? 'false' : 'true');
        this.root.classList.toggle('is-loading', !!on);
    };

    Viewer.prototype._teardownSlide = function () {
        if (this.video) { try { this.video.pause(); } catch (e) {} this.video = null; }
        if (this.slideEl && this.slideEl.parentNode) this.slideEl.parentNode.removeChild(this.slideEl);
        this.slideEl = null;
        this.blocks = [];
        this._ctaEl = null;
        this._showLoading(false);
    };

    Viewer.prototype._stopLoop = function () {
        if (this.rafId) { cancelAnimationFrame(this.rafId); this.rafId = null; }
        this.playing = false;
    };

    Viewer.prototype._trapFocus = function (e) {
        var focusables = this.root.querySelectorAll('button, a[href], [tabindex]:not([tabindex="-1"])');
        var list = Array.prototype.filter.call(focusables, function (n) { return !n.hidden && n.offsetParent !== null; });
        if (!list.length) return;
        var first = list[0], last = list[list.length - 1];
        if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
        else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    };

    /* ============================ utils ============================ */

    function now() {
        return (window.performance && performance.now) ? performance.now() : Date.now();
    }

    function isArabic(str) {
        return /[؀-ۿݐ-ݿࢠ-ࣿﭐ-﷿ﹰ-﻿]/.test(str || '');
    }

    function formatDate(iso) {
        if (!iso) return '';
        var d = new Date(iso);
        if (isNaN(d.getTime())) return iso;
        try {
            var loc = document.documentElement.getAttribute('lang') || 'en';
            return d.toLocaleDateString(loc, { year: 'numeric', month: 'short' });
        } catch (e) {
            return iso;
        }
    }
})();
