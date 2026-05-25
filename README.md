# RS Admin Basic

This is a legacy PHP/CSS/JS/HTML admin panel skeleton with no modern framework or migrations.

## Project structure

- `admin/` - main PHP app and legacy admin pages
- `admin/lib/` - shared PHP libraries and page components
- `admin/__config.php` - database and global configuration
- `admin/__ajax.php` - legacy AJAX/API entrypoint
- `admin/__menu.php` - sidebar menu definition and permissions
- `admin/__settings.php` - global lookup arrays and settings
- `admin/database.txt` - exported MySQL schema and sample data
- `admin/db/init.sql` - MySQL initialization SQL for local development
- `admin/PROJECT_ARCHITECTURE.md` - architecture summary and code flow
- `admin/MIGRATION_PLAN.md` - migration strategy for the legacy schema

## Local setup

### Requirements

- PHP installed locally
- MySQL or MariaDB server available

### Prepare the database

Create the `blank` schema and import the initialization SQL from `admin/db/init.sql`.

From the project root:

```bash
cd /Users/iqhwanajmaeen/Documents/Codes/RS Admin/Basic
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS blank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root blank < admin/db/init.sql
```

If your MySQL server uses a password, replace `-p` with the appropriate credentials.

### Configure the app

Open `admin/__config.php` and make sure the database settings match your local environment:

```php
$mysqli_host = "localhost";
$mysqli_username = "root";
$mysqli_password = "";
$mysqli_schema = "blank";
```

Update these values if you use a different host, user, or password.

### Run the app locally

Option 1: use PHP built-in server from the project root:

```bash
cd /Users/iqhwanajmaeen/Documents/Codes/RS Admin/Basic
php -S localhost:8000 -t admin
```

Then open `http://localhost:8000` in your browser.

Option 2: place the `admin/` folder under a local web server document root and browse to `index.php`.

### Optional: use phpMyAdmin

This repo does not ship phpMyAdmin, but you can install it inside `admin/` and serve it from the same PHP server.

1. Download phpMyAdmin from https://www.phpmyadmin.net/downloads/ or use Composer.
2. Extract it into `admin/phpmyadmin`.
3. If needed, copy `admin/phpmyadmin/config.sample.inc.php` to `admin/phpmyadmin/config.inc.php` and set the blowfish secret:

```php
$cfg['blowfish_secret'] = 'replace-with-a-random-string';
```

4. Run the app server from the project root:

```bash
php -S localhost:8000 -t admin
```

5. Open phpMyAdmin in your browser:

```text
http://localhost:8000/phpmyadmin
```

Connect using the database settings from `admin/__config.php`:

- Host: `localhost`
- User: `root`
- Password: (empty)
- Database: `blank`

If you prefer a separate port:

```bash
cd admin/phpmyadmin
php -S localhost:8001
```

Then browse to `http://localhost:8001`.

### Migration guidance

This project now includes a simple PHP CLI migration runner.

- Use `admin/db/init.sql` as the current schema snapshot.
- Place ordered SQL files in `admin/migrations/`.
- Run migrations with:

```bash
php admin/migrate.php
```

The script creates and tracks applied migrations in `schema_migrations`.

Use `admin/MIGRATION_PLAN.md` to design your migration strategy and add new SQL files in `admin/migrations/`.

## Notes

- The codebase is legacy and uses direct PHP includes and raw SQL.
- `admin/db/init.sql` is the base initialization script for the `blank` database.
- `admin/database.txt` contains an exported schema and sample data.
