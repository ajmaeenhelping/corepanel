# CorePanel — SQL migrations

This folder holds ordered SQL migration files for CorePanel. The runner (`admin/migrate.php`) applies any file not yet recorded in `schema_migrations`.

## Naming rules

- Three-digit numeric prefix for ordering: `010_add_new_column.sql`
- Lowercase, snake_case description after the prefix
- One concern per file
- Don't reuse a prefix once committed

## Examples

- `001_create_employee.sql`
- `002_create_setup.sql`
- `009_add_language_columns.sql`

## Run

From the project root:

```bash
php admin/migrate.php
```

The runner creates the `blank` schema if missing, ensures `schema_migrations` exists, then applies pending migrations in order.

See [`../MIGRATION_PLAN.md`](../MIGRATION_PLAN.md) for the full migration strategy and the list of tables required by core libs.
