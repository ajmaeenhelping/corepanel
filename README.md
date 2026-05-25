# CorePanel

CorePanel is a legacy-style PHP admin panel paired with a public-facing corporate website at the project root. No framework — raw PHP + MySQL throughout. Renamed from "Blank 4" → **CorePanel**.

## Project structure

```
Basic/
├── index.php               ← public homepage (Bootstrap 5)
├── includes/               ← public site header/footer partials
├── assets/                 ← public CSS, JS, images
├── uploads/                ← public uploads
├── config/
│   ├── config.php          ← shared DB + site config (single source of truth)
│   ├── common.php          ← standalone public utility functions
│   └── lang/               ← public-site translations (en/bm/zh)
├── admin/                  ← CMS / management panel
│   ├── __config.php        ← admin config (loads config/config.php with local fallback)
│   ├── __settings.php      ← global lookup arrays
│   ├── __menu.php          ← sidebar menu + permissions
│   ├── __ajax.php          ← AJAX/API entrypoint
│   ├── migrate.php         ← CLI migration runner
│   ├── migrations/         ← ordered SQL migration files
│   ├── db/init.sql         ← baseline schema snapshot
│   ├── lang/               ← admin translations (en/bm/zh)
│   ├── uploads/            ← admin-side file uploads
│   ├── phpmyadmin/         ← phpMyAdmin (served on port 8001)
│   └── lib/                ← shared admin libraries (common.lib, fileupload.lib, etc.)
└── CLAUDE.md               ← project memory for Claude
```

## Database

- **Host**: `localhost`
- **Schema**: `blank`
- **User**: `root`
- **Password**: `12345678`
- **Charset**: `utf8`

Update these in [`config/config.php`](config/config.php) if your local environment differs.

### Tables

| Table | Purpose |
|-------|---------|
| `employee` | Admin panel user accounts |
| `setup` | Global system config (row `id=1` loaded on every admin page) |
| `banner` | Banner images |
| `cat` | Categories (used by `itm`) |
| `page` | CMS static page content |
| `demo` | Full-featured demo/showcase table |
| `itm` | Items linked to categories (FK → `cat`) |
| `email_template` | Email templates used by `sendMail()` |
| `schema_migrations` | Migration tracking |

## Local setup

### Requirements

- PHP 7.4+ (tested on PHP 8.5)
- MySQL or MariaDB server

### Initialize the database

From the project root:

```bash
php admin/migrate.php
```

The runner connects without a DB first, creates `blank` if missing, then applies any pending migrations in `admin/migrations/` (`000_*.sql` → `00N_*.sql`). Applied migrations are tracked in the `schema_migrations` table.

If you'd rather load the baseline snapshot directly:

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS blank CHARACTER SET utf8 COLLATE utf8_general_ci;"
mysql -u root -p blank < admin/db/init.sql
```

### Run the app locally

Two layouts are supported:

```bash
# Option A — public site + admin via /admin
cd "/Users/iqhwanajmaeen/Documents/Codes/RS Admin/Basic"
php -S localhost:8000

# Option B — admin only (docroot is admin/)
php -S localhost:8000 -t admin
```

- Public site: <http://localhost:8000>
- Admin panel: <http://localhost:8000/admin> (option A) or <http://localhost:8000> (option B)

### Optional: phpMyAdmin

Bundled under `admin/phpmyadmin/`. Serve on its own port:

```bash
cd admin/phpmyadmin
php -S localhost:8001
```

Then open <http://localhost:8001> and connect with the credentials from `config/config.php`.

## Admin login

- **Username**: `admin`
- **Password**: `admin`
- **Session prefix**: `catmgr_blank3_`

Toggles in [`admin/__config.php`](admin/__config.php):

```php
$debug_mode         = 0;  // 1 = show PHP errors on screen (dev only)
$disable_rightclick = 1;  // 1 = disable right-click on admin pages
```

## Migrations

Place ordered SQL files in `admin/migrations/` (e.g. `010_add_audit_columns.sql`) and run:

```bash
php admin/migrate.php
```

See [`admin/MIGRATION_PLAN.md`](admin/MIGRATION_PLAN.md) for the migration strategy and [`admin/migrations/README.md`](admin/migrations/README.md) for naming rules.

## Language system

Three languages: English (default), Bahasa Malaysia (`bm`), Simplified Mandarin (`zh`).

- **UI strings** live in `admin/lang/{en,bm,zh}.php` and `config/lang/{en,bm,zh}.php`; access via `t('nav.home')`.
- **DB content** uses column suffixes (`data`, `data_bm`, `data_zh` on `email_template`, `page`). `$lg` is set automatically by the language loader.
- Topbar shows **EN · BM · 中** buttons; switching appends `?setlang=bm` / `?setlang=zh` and persists in the session.

## Architecture & deeper docs

- [`admin/PROJECT_ARCHITECTURE.md`](admin/PROJECT_ARCHITECTURE.md) — runtime flow, libs, conventions
- [`admin/MIGRATION_PLAN.md`](admin/MIGRATION_PLAN.md) — migration strategy
- [`CLAUDE.md`](CLAUDE.md) — full project memory (paths, patterns, gotchas)
