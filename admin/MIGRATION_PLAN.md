Migration Plan for Legacy PHP Admin Panel

Problem:
- This project currently has no migration records or schema version tracking.
- Database schema changes are likely managed manually, which makes deployments and upgrades risky.

Recommended migration strategy:
1. Add a migration table
   - create a new table such as `schema_migrations` with columns:
     - `id` INT AUTO_INCREMENT PRIMARY KEY
     - `migration` VARCHAR(255) NOT NULL
     - `applied_at` DATETIME NOT NULL
   - store one row per applied migration file/name.

2. Organize migrations as SQL + metadata
   - create `admin/migrations/` or `admin/db/migrations/`
   - name files sequentially, e.g. `001_create_employee.sql`, `002_add_banner_columns.sql`
   - each file should contain the SQL needed to apply the change
   - optionally include a matching rollback file if you want reversible changes

3. Create a simple migration runner
   - add `admin/migrate.php`
   - it should:
     - connect with `__config.php`
     - ensure `schema_migrations` exists
     - scan migration files in order
     - execute any not yet applied
     - record each applied migration in `schema_migrations`
   - The included `admin/migrate.php` script now implements this behavior.

4. Use migration files for every new table/column
   - do not make schema changes directly in production without a migration record
   - each feature should include a corresponding migration
   - example:
     - `003_create_cat_table.sql`
     - `004_add_description_to_banner.sql`

5. Keep data seeds and lookups explicit
   - if a new feature requires lookup values, add a seed SQL file such as
     `005_seed_paytype_values.sql`
   - avoid embedding important default data only in PHP code

6. Document schema dependencies
   - add notes in `MIGRATION_PLAN.md` for any tables that are required by core libs such as `employee` and `setup`
   - record the purpose of each table

Practical starting migration files:
- `000_create_schema_migrations.sql`
- `001_create_employee_table.sql`
- `002_create_setup_table.sql`
- `003_create_email_template_table.sql`

Tips for conversion:
- start by reverse-engineering the current database schema from the admin pages and SQL queries
- build a baseline migration set that represents the current state
- then add incremental migration files for every new change going forward

Outcome:
- future database changes become repeatable, auditable, and deployable
- you can safely clone the repo, run migrations, and reproduce the DB structure
- this is the correct modernization step for a legacy PHP monorepo without a framework
