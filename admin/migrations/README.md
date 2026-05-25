This folder contains ordered SQL migration files for the legacy admin panel.

Naming rules:
- Use a numeric prefix for ordering, e.g. `001_add_new_column.sql`
- Keep names unique and descriptive
- Each file may contain multiple valid MySQL statements

Example:
- `001_create_example_table.sql`
- `002_add_banner_description.sql`

Run migrations from the project root:

```bash
php admin/migrate.php
```

The script tracks applied migrations in the `schema_migrations` table.
