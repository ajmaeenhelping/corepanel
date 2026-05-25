# Project Memory — CorePanel (RS Admin Basic)

## Overview
Legacy PHP admin panel with a public-facing corporate website at the root. No framework. Raw PHP + MySQL throughout.
Project was renamed from "Blank 4" → **CorePanel** across all config files.

---

## Folder Structure
```
Basic/
├── index.php               ← public homepage (Bootstrap 5)
├── includes/
│   ├── header.php          ← public navbar + <head>
│   └── footer.php          ← public footer + scripts
├── assets/
│   ├── css/style.css       ← public custom CSS
│   ├── js/main.js          ← public JS (counter, scroll, form)
│   └── img/
├── uploads/                ← public uploads folder
├── config/
│   ├── config.php          ← shared DB + site config (single source of truth)
│   └── common.php          ← standalone public utility functions (mirrors admin/lib/common.lib)
├── admin/                  ← CMS / management panel
│   ├── __config.php        ← admin config (requires config/config.php, fallback local)
│   ├── __settings.php      ← global lookup arrays
│   ├── __menu.php          ← sidebar menu + permissions
│   ├── __ajax.php          ← AJAX/API entrypoint
│   ├── migrate.php         ← CLI migration runner
│   ├── migrations/         ← ordered SQL migration files
│   ├── db/init.sql         ← baseline schema snapshot
│   ├── uploads/            ← admin-side file uploads
│   ├── phpmyadmin/         ← phpMyAdmin (port 8001)
│   └── lib/
│       ├── common.lib      ← core admin utility library
│       ├── fileupload.lib  ← file upload handler
│       └── *.lib           ← form, listing, SQL, menu, header, footer libs
└── CLAUDE.md               ← this file
```

---

## Database
- **Host**: localhost
- **Schema**: `blank`
- **User**: `root`
- **Password**: `12345678`
- **Charset**: `utf8`

### Tables
| Table | Purpose |
|-------|---------|
| `employee` | Admin panel user accounts |
| `setup` | Global system config (colors, settings) — row id=1 always loaded |
| `banner` | Banner images |
| `cat` | Categories (used by `itm`) |
| `page` | CMS static page content |
| `demo` | Full-featured demo/showcase table |
| `itm` | Items linked to categories (FK → cat) |
| `email_template` | Email templates used by `sendMail()` |
| `schema_migrations` | Migration tracking |

---

## Migrations
Runner: `php admin/migrate.php` (CLI only)
- Connects without DB first, creates `blank` if missing, then runs migrations in order
- Files in `admin/migrations/` named `000_*.sql` → `008_*.sql`
- `000` = create database, `001`–`008` = individual tables

---

## Local Dev Servers
```bash
# Public site + admin CMS
php -S localhost:8000 -t admin    # admin only
php -S localhost:8000             # public + admin via /admin

# phpMyAdmin (separate port)
cd admin/phpmyadmin && php -S localhost:8001
```
- Public: http://localhost:8000
- Admin: http://localhost:8000/admin or http://localhost:8000 (if -t admin)
- phpMyAdmin: http://localhost:8001

---

## Admin Panel
- **Login**: username `admin`, password `admin` (MD5: `b4e9662fef8c7cb2149f87a439dbdd3f`)
- **Session prefix**: `catmgr_blank3_`
- **Entry point**: `admin/index.php` → `admin/login.php`
- `$gen` = `SELECT * FROM setup WHERE id = 1` — loaded on every admin page via `common.lib`

### Key Config Toggles (`admin/__config.php`)
```php
$debug_mode         = 0;  // 1 = show PHP errors (dev only)
$disable_rightclick = 1;  // 1 = right-click disabled, 0 = allowed
```

---

## Admin UI Theme
- **Style**: Dark sidebar + light content (Filament/Livewire-inspired)
- **Sidebar**: `#0f172a` dark navy, 260px wide, collapses off-canvas on mobile
- **Topbar**: white, sticky, 60px, shows page title + Settings/Logout links
- **Content bg**: `#f1f5f9`
- **Font**: Inter (Google Fonts, loaded in header.lib / header1.lib)
- **CSS location**: `admin/lib/img/style.css` (full rewrite, all legacy class names preserved)

### Layout lib files flow
| File | Role |
|------|------|
| `header.lib` | Opens HTML, loads CSS/JS, renders sidebar shell |
| `menu.lib` | Renders sidebar nav links + closes sidebar, opens main-wrapper + topbar + main-content |
| `subheader.lib` | Page header (title), opens `<form>`, calls notification.lib |
| `subfooter.lib` | Closes `</form>` |
| `footer.lib` | Closes main-content, main-wrapper, adds sidebar JS toggle, closes HTML |
| `header1.lib` | Login-only header — no sidebar, renders login card open |
| `footer2.lib` | Login-only footer — closes login card + HTML |
| `notification.lib` | Modern success/error alert banners |

---

## Core Libraries

### `config/common.php` (public)
Standalone mirror of admin functions. One line to use on any public page:
```php
require_once __DIR__ . '/config/common.php';
```
Provides: `mq`, `mfa`, `mnr`, `hsc`, `frm`, `frmp`, `frmg`, `frmr`, `clean`, `get`, `set`, `getc`, `setc`, `go`, `pageurl`, `now`, `sdf`, `sdtf`, `sdfnm`, `stf`, `sdfd`, `sdfm`, `sdfy`, `moddate`, `dfi`, `dfd`, `isint`, `isdbl`, `isemail`, `isphone`, `isurl`, `isdate`, `isnulldate`, `isalphanum`, `chk`, `cint`, `cdbl`, `cbx`, `cbool`, `rnd`, `pad`, `lnbr`, `xxx`, `asl`, `rvd`, `epfx`, `upfx`

### `admin/lib/common.lib` (admin)
Same functions but also handles: DB connect, session start, admin session guard, host domain lock, concurrency check, `$gen` setup query. Loaded via `header.lib` on every admin page.

### `admin/lib/fileupload.lib`
Handles file uploads. Supports two path variables:
- `$uploadFolderPrefix` — relative path stored in DB (e.g. `uploads/`)
- `$uploadAbsolutePrefix` — absolute path for actual file write (e.g. `__DIR__ . "/uploads/"`)

**Always set both in any page that does uploads:**
```php
$uploadFolderPrefix   = $folder_path;
$uploadAbsolutePrefix = __DIR__ . "/" . $folder_path;
```
Without `$uploadAbsolutePrefix`, uploads silently fail (white screen) when PHP server runs from root.

---

## Public Site (Bootstrap 5)
- Font: Inter (Google Fonts)
- Primary color: `#01a0c8`, Secondary: `#00dc9f`
- CSS variables in `:root`, Bootstrap primary overridden
- Sections: Navbar (sticky+shrink), Hero (animated blob), Services (6 cards), About (2-col), Stats (animated counters), Contact (form), Footer
- `$site_name`, `$company_name`, `$site_email` etc. pulled from `config/config.php`

---

## Known Patterns & Conventions
- Sidebar groups: use `"__group"` as the file value in `$mn_flux` — `menu.lib` renders it as a `.sidebar-group-label` divider instead of a link. Format: `perm, "__group", "nav.key", ""`
- All admin pages follow: `require "__config.php"` → include `header.lib` → define `$p_flux` or `$c_flux` → include processing libs → include display libs → include `footer.lib`
- `$p_flux` = form field definitions (4 values per field: key, label, type, validation)
- `$c_flux` = list column definitions (6 values per column)
- `$multipart=1` must be set on any page with file uploads
- Error display is suppressed by default — flip `$debug_mode = 1` to diagnose white screens
- `sendMail()` in `common.lib` requires `email_template` table with columns: `code`, `heading`, `data`
- `$lg` is set by the lang loader: `""` = EN (default), `"_bm"` = BM, `"_zh"` = ZH — auto-selects the right DB column suffix

---

## Language System

**3 languages**: English (EN, default), Bahasa Malaysia (BM), Simplified Mandarin (ZH)

**Hybrid approach:**
- **File-based** → admin UI strings (labels, buttons, nav, errors)
- **Column-suffix** → DB content (email templates, page content)

### File-based (UI strings)
```
admin/lang/en.php   ← default, always matches English
admin/lang/bm.php   ← Bahasa Malaysia
admin/lang/zh.php   ← Simplified Mandarin
config/lang/        ← same 3 files for public site
```
- Loaded in `common.lib` / `config/common.php` after session start
- Sets `$LANG` (array) and `$lg` (suffix string)
- Use `t('nav.home')` anywhere — falls back to the key if missing

### Column-suffix (DB content)
```
email_template: heading, heading_bm, heading_zh / data, data_bm, data_zh
page:           data, data_bm, data_zh   (base column is `data`, not `content`)
```
- `$lg` is set automatically: `""` for EN, `"_bm"` for BM, `"_zh"` for ZH
- `sendMail()` already uses `$lg` — just populate the `_bm` / `_zh` columns
- Migration: `009_add_language_columns.sql`

### Switching language
- Topbar shows **EN · BM · 中** buttons — links append `?setlang=bm` / `?setlang=zh`
- `common.lib` reads `$_GET['setlang']`, validates, stores in session
- Persists for the whole browser session
