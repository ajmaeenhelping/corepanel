# CorePanel — Migration Plan

CorePanel uses an in-tree PHP migration runner. Every schema change should ship as a migration file so the DB can be reproduced from a clean clone.

## Runner

```bash
php admin/migrate.php
```

- Connects without selecting a DB, creates the `blank` schema if missing.
- Ensures `schema_migrations` exists.
- Scans `admin/migrations/` in filename order.
- Applies any file not yet recorded in `schema_migrations`, then inserts a row.

## File layout

- `admin/migrations/` — ordered SQL files (`000_*.sql`, `001_*.sql`, …)
- `admin/db/init.sql` — baseline schema snapshot (rebuilt when migrations change shape significantly)
- `schema_migrations` table — applied migration tracking (`id`, `migration`, `applied_at`)

## Current migrations

| # | File | Purpose |
|---|------|---------|
| 000 | `000_create_database.sql` | Create `blank` schema |
| 001–008 | per-table | Individual table creation (`employee`, `setup`, `banner`, `cat`, `page`, `demo`, `itm`, `email_template`) |
| 009 | `009_add_language_columns.sql` | `_bm` / `_zh` column suffixes on `email_template`, `page` |

## Conventions

1. **One concern per file.** Don't combine unrelated changes — it makes rollback harder and `schema_migrations` less informative.
2. **Sequential numeric prefix.** `010_…`, `011_…`, etc. Don't reuse a prefix.
3. **Reversible when possible.** If a change is destructive (dropping a column, renaming a table), document the rollback in a comment at the top of the file.
4. **Idempotent statements where it matters.** `CREATE TABLE IF NOT EXISTS`, `ALTER TABLE … ADD COLUMN IF NOT EXISTS` (when supported). Helps when a partially-applied migration needs to be re-run.
5. **Seed data lives in migrations.** Don't rely on PHP code to insert default lookups — add an explicit seed file like `0NN_seed_paytype_values.sql`.

## When to update `db/init.sql`

`db/init.sql` is the baseline snapshot. Rebuild it after a batch of migrations that meaningfully change the public schema (so new contributors don't need to run every historical migration from scratch). After regenerating:

```bash
mysqldump --no-data --skip-comments blank > admin/db/init.sql
mysqldump --no-create-info --skip-comments blank schema_migrations >> admin/db/init.sql
```

Then commit `init.sql` alongside the new migrations.

## Tables required by core libs

Some tables are load-bearing for the runtime — removing them will break every admin page:

| Table | Used by |
|-------|---------|
| `employee` | session auth + concurrency check in `lib/common.lib` |
| `setup` | `$gen = mfa(mq("SELECT * FROM setup WHERE id = 1"))` on every page |
| `email_template` | `sendMail()` in `lib/common.lib` |
| `schema_migrations` | the migration runner itself |

Keep these intact, or add new migrations that preserve the columns these helpers read.
