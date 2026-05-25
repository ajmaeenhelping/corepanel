Project Architecture Summary

- Type: legacy PHP/CSS/JS/HTML application
- No framework, no migrations, no modern frontend build system
- Mono repo base version: plug-and-play admin panel skeleton

Core structure:
- `__config.php` loads DB credentials, global site variables, session prefix, and app URLs.
- `lib/common.lib` is the bootstrap and shared runtime environment:
  - starts PHP session
  - connects to MySQL using `mysqli`
  - imports `__settings.php` and `__menu.php`
  - defines request helpers (`frm`, `frmp`, `frmg`, `clean`)
  - defines shortcuts for SQL (`mq`, `mfa`, `mnr`)
  - handles session-based auth and page protection
  - applies a host-domain lock unless running on `localhost`

Routing and page pattern:
- `index.php` redirects to `login.php` or `home.php` based on session `usr`
- Most pages are simple PHP files that declare page metadata and then include shared libs
- Standard module pair:
  - `X.php` for listing/searching/deleting data
  - `X_info.php` for add/edit form and submit handling
- Page metadata arrays:
  - `c_flux` defines list columns for `X.php`
  - `p_flux` defines form fields for `X_info.php`
- Shared page sections are composed via `lib/*.lib` includes:
  - `header.lib`, `footer.lib`, `menu.lib`
  - `listing.lib`, `search.lib`, `forms.lib`, `sqlinsert.lib`, `sqlupdate.lib`, `sqlselect.lib`

Menu and permissions:
- `__menu.php` holds the sidebar menu item list
- Each row is a flat array: `perm`, `file`, `label`, `icon`
- `perm` restricts access based on session flags like `isadmin`
- `file` is the destination page

AJAX and client API:
- `__ajax.php` is a function-based AJAX router with `fn`, `q`, and other query params
- It does not use JSON API conventions; it returns HTML, JS snippets, or simple text
- Example functions: `countchr`, `changeclr`, `searchitm`, `lstitm`, `upditm`, `delitm`

Settings and lookup data:
- `__settings.php` defines lookup arrays such as `paytype`, `pstatus`, `ostatus`, `month`
- These are used across pages to render dropdowns and status labels

Authentication:
- Session functions use a prefix from `__config.php`: `set()` / `get()`
- If `usr` is missing, `lib/common.lib` redirects protected pages to `logout.php`
- There is a concurrency check on the `employee` table column `skey`

Data layer:
- The app assumes a MySQL schema but no migration tracking exists
- Tables are referenced directly by hardcoded names like `employee`, `banner`, `cat`, `page`, `itm`
- SQL queries are built with string concatenation and `clean()` escaping

What to master first:
1. `__config.php` + `lib/common.lib`: runtime setup, DB, session, helpers
2. `__menu.php`: how navigation and permissions are declared
3. `X.php` / `X_info.php` patterns: list page metadata vs form page metadata
4. `lib/*.lib`: page composition and CRUD helper flow
5. `__ajax.php`: AJAX command routing and JS data exchange

Next step:
- treat this as a scaffold where each new module follows the same `list/edit` pattern
- standardize new DB table additions by creating metadata in the page and a matching `_info` form
- add migration tracking before changing schema
