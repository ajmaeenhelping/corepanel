# CorePanel — Project Architecture

CorePanel is a legacy PHP/CSS/JS application with no framework. The project root hosts a public Bootstrap 5 site; `admin/` contains the CMS / management panel. The two share `config/config.php` for DB and site identity.

## Top-level layout

```
Basic/
├── index.php               public homepage
├── includes/               public header/footer
├── assets/                 public CSS/JS/images
├── config/
│   ├── config.php          shared DB + site config (single source of truth)
│   ├── common.php          public-side utility lib (mirrors admin common.lib)
│   └── lang/               public translations
└── admin/                  admin panel (this folder)
```

## Admin runtime

- `__config.php` loads `../config/config.php` when present; falls back to local defaults otherwise. Also defines `$session_pfx`, `$mce_base_url`, `$lib_base`, and dev toggles (`$debug_mode`, `$disable_rightclick`).
- `lib/common.lib` is the bootstrap and shared runtime:
  - starts the PHP session
  - connects to MySQL via `mysqli`
  - loads `__settings.php`, `__menu.php`, and language file (`../lang/{en,bm,zh}.php`)
  - defines request helpers (`frm`, `frmp`, `frmg`, `clean`) and SQL shortcuts (`mq`, `mfa`, `mnr`)
  - enforces session auth (redirects to `logout.php` if no `usr` session) and concurrency check on `employee.skey`
  - applies a host-domain lock unless `host_domain == "localhost"`
- `lib/fileupload.lib` handles uploads. Pages that upload must set both `$uploadFolderPrefix` (DB-relative path) and `$uploadAbsolutePrefix` (filesystem path).

## Page conventions

- `index.php` → redirects to `login.php` or `home.php` based on session
- Most modules are pairs:
  - `X.php` — listing/search/delete
  - `X_info.php` — add/edit form + submit handling
- Metadata arrays describe pages:
  - `$c_flux` — list columns (6 values per column) for `X.php`
  - `$p_flux` — form fields (4 values per field) for `X_info.php`
- Composition via `lib/*.lib` includes:
  - layout: `header.lib`, `menu.lib`, `subheader.lib`, `subfooter.lib`, `footer.lib`
  - login-only layout: `header1.lib`, `footer2.lib`
  - data flow: `listing.lib`, `search.lib`, `forms.lib`, `sqlinsert.lib`, `sqlupdate.lib`, `sqlselect.lib`, `sqlbasic.lib`

## Menu & permissions

`__menu.php` defines `$mn_flux` — a flat array of `perm, file, label, icon` rows.

- `perm` restricts visibility based on session flags (e.g. `isadmin`).
- `file` is the destination page; using `"__group"` renders a group label divider instead of a link.

## AJAX

`__ajax.php` is a function-based router driven by query params (`fn`, `q`, …). It returns HTML/JS/text snippets rather than JSON. Examples: `countchr`, `changeclr`, `searchitm`, `lstitm`, `upditm`, `delitm`.

## Settings & lookups

`__settings.php` defines lookup arrays (`paytype`, `pstatus`, `ostatus`, `month`, …) used to render dropdowns and status labels across pages.

## Authentication

- Session prefix from `__config.php` (`$session_pfx = "catmgr_blank3_"`)
- Helpers `set()` / `get()` apply the prefix automatically
- `lib/common.lib` redirects protected pages to `logout.php` when `usr` is missing
- `omit_file` (in `common.lib`) lists pages exempt from the auth guard: `index.php`, `login.php`, `__ajax.php`, `api.php`, `forgot.php`
- Concurrency check compares `employee.skey` to the session `skey`

## Data layer

- MySQL schema is tracked via migration files in `migrations/` and the `schema_migrations` table.
- `db/init.sql` is the baseline schema snapshot.
- Queries are built with string concatenation + `clean()` escaping (`mysqli_real_escape_string`).

## Languages

Three languages: `en` (default), `bm` (Bahasa Malaysia), `zh` (Simplified Mandarin).

- UI strings: file-based, loaded by `common.lib` from `../lang/<code>.php` into `$LANG`; access via `t('key')`.
- DB content: column-suffix approach. `$lg` is `""` for `en`, `"_bm"` / `"_zh"` otherwise. Used by `sendMail()` and any content fetcher that needs to select the right column.
- Switching: `?setlang=bm` / `?setlang=zh` stored in the session; topbar exposes **EN · BM · 中** buttons.

## What to master first

1. `__config.php` + `lib/common.lib` — runtime, DB, session, helpers
2. `__menu.php` — navigation and permission gates
3. `X.php` / `X_info.php` pattern — list vs form metadata
4. `lib/*.lib` — page composition and CRUD helpers
5. `__ajax.php` — AJAX routing
6. `migrate.php` + `migrations/` — schema changes
