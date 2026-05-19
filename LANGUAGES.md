# Adding a New Language

This project's localization is fully data-driven. To add a new language, follow these steps. **No code changes required** — the navbar switcher, `<html lang/dir>` attributes, and all UI strings update automatically.

## Example: Adding Arabic (RTL)

### 1. Register the locale in `config/app.php`

In the `available_locales` array, uncomment or add the entry:

```php
'available_locales' => [
    'en' => ['name' => 'English', 'native' => 'EN',   'flag' => '🇬🇧', 'dir' => 'ltr'],
    'ar' => ['name' => 'Arabic',  'native' => 'عربي', 'flag' => '🇸🇦', 'dir' => 'rtl'],
],
```

Keys:
- `name` — full English name shown in the dropdown
- `native` — short label shown in the navbar trigger (typically the language code)
- `flag` — emoji or text glyph rendered next to the name
- `dir` — `ltr` or `rtl`; controls the `<html dir>` attribute site-wide

### 2. Translate the language files

Copy every PHP file from `lang/en/` to `lang/ar/` and translate the **values** (leave the keys exactly the same):

```
lang/
├── en/
│   ├── nav.php
│   ├── buttons.php
│   ├── footer.php
│   ├── sections.php
│   └── general.php
└── ar/
    ├── nav.php          ← copy + translate values
    ├── buttons.php
    ├── footer.php
    ├── sections.php
    └── general.php
```

Example `lang/ar/nav.php`:

```php
<?php
return [
    'home'      => 'الرئيسية',
    'partners'  => 'الشركاء',
    'services'  => 'الخدمات',
    // ...
];
```

### 3. Load a script-appropriate font (RTL-friendly)

Edit `resources/views/layouts/app.blade.php` and conditionally load an Arabic-friendly font when the active locale is `ar`:

```blade
@if(app()->getLocale() === 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;600;700&display=swap" rel="stylesheet">
@endif
```

Then update `resources/css/app.css` `@theme` block to swap the sans-serif font when the document is in RTL:

```css
html[dir="rtl"] {
    --font-sans: 'Tajawal', ui-sans-serif, system-ui, sans-serif;
}
```

### 4. Audit the layout for hard-coded directionality

The codebase already uses Tailwind logical properties (`ps-*`, `pe-*`, `ms-*`, `me-*`, `start-*`, `end-*`) in newer components. Older code may still have `pl-*` / `pr-*` / `ml-*` / `mr-*` — those need a one-time migration. Search for these directional utilities and replace them with the logical equivalents:

| Replace | With |
|---|---|
| `pl-*` | `ps-*` |
| `pr-*` | `pe-*` |
| `ml-*` | `ms-*` |
| `mr-*` | `me-*` |
| `left-*` | `start-*` |
| `right-*` | `end-*` |
| `text-left` | `text-start` |
| `text-right` | `text-end` |

For one-off RTL-specific overrides, prefer the `rtl:` Tailwind variant rather than CSS overrides.

### 5. Test

1. Click the language switcher in the navbar → the new locale appears with its flag and native label.
2. Selecting it reloads the page and persists across navigation via the session.
3. View source: `<html lang="ar" dir="rtl">`.
4. Confirm fonts, layout direction, and all translated strings render correctly.
5. Test mobile menu, footer columns, and CTAs.

---

## Translation strings reference

All UI strings live in `lang/{locale}/` and are accessed via the `__()` helper. The key namespaces:

| File | Purpose |
|---|---|
| `nav.php` | Navbar link labels |
| `buttons.php` | Reusable CTAs ("Visit our website", etc.) |
| `footer.php` | Footer column headings, copyright, contact strings |
| `sections.php` | Section eyebrows, headlines, descriptions, vertical-rail labels |
| `general.php` | Generic UI (skip link, menu toggles, locale switcher labels) |

### What is NOT translated

The following text is hard-coded by design and stays the same across locales:

- Brand names: `Champions Group`, `Champions Hub`, `Champions LMS`, `Champions Academy`, `Champions Club`, `Al Jalaa'`, `EgytalHub`
- Numeric statistics: `8,000`, `+200K`, `100%`, `12 YR`, etc.
- Partner names: Pepsi, UNRWA, FC Barcelona, etc. (these are external proper nouns)
- Stat labels (e.g., "Employees", "Sports Academies") — currently English-only; can be migrated later if needed

---

## Where the locale plumbing lives

| Concern | File |
|---|---|
| Available locale registry | `config/app.php` → `available_locales` |
| Switch route | `routes/web.php` → `locale.switch` |
| Switch handler | `app/Http/Controllers/LocaleController.php` |
| Apply locale per request | `app/Http/Middleware/SetLocale.php` (registered in `bootstrap/app.php`) |
| Switcher UI (desktop dropdown + mobile chips) | `resources/views/components/navbar.blade.php` |
| Locale-aware `<html lang/dir>` | `resources/views/layouts/app.blade.php` |
