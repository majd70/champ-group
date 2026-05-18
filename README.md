# Champions Group

A pixel-faithful Laravel rebuild of the 12-page **Champions Group** corporate presentation — a diversified sports ecosystem advancing the sports sector in MENA since 2015.

The full deck is rendered as a single scrolling page, with each PDF slide mapped to one Blade section.

---

## Stack

| Layer | Tech |
|---|---|
| Framework | Laravel 11 |
| Templating | Blade (anonymous components) |
| Styling | Tailwind CSS v4 (CSS-first config via `@theme`) |
| Bundler | Vite 7 |
| Frontend JS | None — static, no framework |

---

## What the project is

The source is a 12-page PDF presentation rendered as PNGs in `champ-images/page-renders/page-01.png` through `page-12.png`. Each section of the site rebuilds one of those pages using **HTML + Tailwind for everything text, color, and layout-based**, and only crops out actual logos and photographs from the page-renders as `<img>` assets.

The architecture is a **single scrolling page** (one route `/`, 12 sections) because the deck tells a continuous narrative — splitting it into separate routes would fragment the story without any SEO or UX benefit.

### Pages

| # | Section | Purpose |
|---|---|---|
| 01 | Hero | Brand cover with shield, stats row, vertical division rail |
| 02 | Partners | 23-logo partner network in International / Regional / Local tiers |
| 03 | Services | 3×3 service tile grid, alternating navy/gold checker |
| 04 | Champions Hub | Education + tech platform with screenshots, stats, partner row |
| 05 | Champions LMS | Multi-tenant learning platform with 3-screen mockup |
| 06 | Champions Academy | 8,000 players developed, 9 sports academies |
| 07 | Press Collage | Editorial photo mosaic — full-bleed |
| 08 | Champions Club | 24,000 m² family club with 40+ partner network |
| 09 | Events Collage | Events and activities photo mosaic — full-bleed |
| 10 | Al Jalaa' | Acquired Gaza club, founded 1992 |
| 11 | Egytalhub | Talent + LD services sub-brand |
| 12 | Thank You | Closing slide |

---

## Design system

Defined in [`resources/css/app.css`](resources/css/app.css) as Tailwind v4 `@theme` tokens.

| Token | Value | Use |
|---|---|---|
| `--color-bg-navy` | `#0A1330` | Page background |
| `--color-panel-olive` | `#343027` | Hero shield panel background |
| `--color-surface-navy` | `#15224A` | Cards, service tiles |
| `--color-divider` | `#26314F` | Hairlines between rows |
| `--color-accent-gold` | `#F4B81E` | Primary accent — stat numbers, italic accents |
| `--color-display-cream` | `#EFE7D2` | Oversized display headings |
| `--color-text-muted` | `#A8B0C2` | Body paragraphs, captions |
| `--color-text-dim` | `#6B7592` | Slide numbers, tertiary metadata |
| `--color-egytal-orange` | `#E67A2A` | Egytalhub sub-brand only (page 11) |
| `--color-egytal-teal` | `#1F8A86` | Egytalhub sub-brand only (page 11) |

### Typography (Google Fonts)

| Role | Font | Notes |
|---|---|---|
| Display | **Anton** 400 (fallback Bebas Neue) | CHAMPIONS, PARTNERS, SERVICES, THANK YOU |
| Italic accent | **DM Serif Display Italic** 400 | "Our", "the", "Champions", "Al" |
| Body | **Inter** 400/500/600 | Paragraphs, labels |
| Eyebrow | **Inter** 500 uppercase, `tracking-[0.18em]` | Section context tags |

---

## File structure

```
resources/
├── css/
│   └── app.css                      ← Tailwind v4 @theme tokens + custom utilities
└── views/
    ├── welcome.blade.php            ← single route, includes all 12 sections
    ├── layouts/
    │   └── app.blade.php            ← <html>, fonts, vite, base styles
    ├── components/                  ← anonymous Blade components
    │   ├── eyebrow.blade.php
    │   ├── stat-block.blade.php
    │   ├── service-tile.blade.php
    │   └── page-footer.blade.php
    └── sections/                    ← one Blade per PDF page
        ├── 01-hero.blade.php
        ├── 02-partners.blade.php
        ├── 03-services.blade.php
        ├── 04-hub.blade.php
        ├── 05-lms.blade.php
        ├── 06-academy.blade.php
        ├── 07-press-collage.blade.php
        ├── 08-club.blade.php
        ├── 09-events-collage.blade.php
        ├── 10-jalaa.blade.php
        ├── 11-egytalhub.blade.php
        └── 12-thank-you.blade.php

public/images/
├── page-01/                         ← shield (cropped from page-render)
├── page-02/                         ← partner-grid (single image crop)
├── page-04/                         ← shield, screenshots, partners
├── page-05/                         ← laptops (LMS product mockup)
├── page-06/                         ← shield, partners
├── page-07/                         ← collage.jpg (full-bleed photo mosaic)
├── page-08/                         ← shield, partners
├── page-09/                         ← collage.jpg (full-bleed photo mosaic)
├── page-10/                         ← shield (Al Jalaa orange phoenix), photos
└── page-11/                         ← logo (Egytalhub ETP triangle)

champ-images/
└── page-renders/                    ← source PDF page renders (1-12)
```

### Image strategy

- **PNG** for logos and shields (alpha edges, hard-edged vectors)
- **JPG quality 85** for photographs and photo collages (`collage.jpg` is 927 KB vs ~7 MB as PNG)
- **No** decorative use of images — every text, color, divider, ring, and frame is HTML + Tailwind
- All crops sourced from `champ-images/page-renders/` using PowerShell + `System.Drawing` (no ImageMagick or Pillow dependency)

---

## Getting started

```bash
# 1. Clone
git clone https://github.com/majd70/champ-group.git
cd champ-group

# 2. Install
composer install
npm install

# 3. Environment
cp .env.example .env
php artisan key:generate

# 4. Dev mode — runs Vite + Laravel together
npm run dev
php artisan serve

# Or production build
npm run build
```

Then open <http://localhost:8000> (or `http://localhost/<path>/public/` if you're serving via XAMPP/Apache).

---

## Conventions

- **Single source of truth**: every design value lives in `app.css` `@theme`. No raw hex in markup.
- **Anonymous Blade components** in `resources/views/components/` for repeated UI primitives (`<x-eyebrow>`, `<x-stat-block>`, `<x-service-tile>`, `<x-page-footer>`).
- **Sections, not pages**: each PDF page is a `<section>` in `resources/views/sections/` — pulled into `welcome.blade.php` with `@include`.
- **Pixel-faithful crops**: when text/UI would be tedious to recreate (logo grids, photo mosaics), the section uses a single image crop from the source render rather than rebuilding the layout cell-by-cell.

---

## Commit history

```
48b080d  Polish hero olive panel + right-column stat alignment
6c0f73e  Build pages 11-12: Egytalhub and Thank You closer
e5e05c5  Build pages 9-10: events collage, Al Jalaa'
03b4b24  Build pages 6-8: academy, press collage, club
1c7a828  Build pages 1-5: hero, partners, services, hub, LMS
```

---

Built with Laravel 11, Tailwind v4, and a 3000×1688 PDF render as the only visual reference.
