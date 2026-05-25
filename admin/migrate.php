<?php
if (PHP_SAPI !== 'cli') {
    echo "This script must be run from the command line:\n";
    echo "  php migrate.php\n";
    exit(1);
}

$configPath = __DIR__ . '/__config.php';
if (!file_exists($configPath)) {
    fwrite(STDERR, "Cannot find __config.php in admin/\n");
    exit(1);
}

require $configPath;

// Connect without selecting a database first so we can create it if needed.
$mysqli = new mysqli($mysqli_host, $mysqli_username, $mysqli_password);
if ($mysqli->connect_errno) {
    fwrite(STDERR, "MySQL connection failed: " . $mysqli->connect_error . "\n");
    exit(1);
}

$mysqli->set_charset('utf8');

// Create the database if it does not exist, then select it.
if (!$mysqli->query("CREATE DATABASE IF NOT EXISTS `{$mysqli_schema}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
    fwrite(STDERR, "Failed to create database: " . $mysqli->error . "\n");
    exit(1);
}

if (!$mysqli->select_db($mysqli_schema)) {
    fwrite(STDERR, "Failed to select database '{$mysqli_schema}': " . $mysqli->error . "\n");
    exit(1);
}

echo "Using database: {$mysqli_schema}\n";

// Ensure the migration tracking table exists.
$createTableSql = <<<'SQL'
CREATE TABLE IF NOT EXISTS schema_migrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  migration VARCHAR(255) NOT NULL UNIQUE,
  applied_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;

if (!$mysqli->query($createTableSql)) {
    fwrite(STDERR, "Failed to create schema_migrations: " . $mysqli->error . "\n");
    exit(1);
}

$migrationsDir = __DIR__ . '/migrations';
if (!is_dir($migrationsDir)) {
    if (!mkdir($migrationsDir, 0755, true)) {
        fwrite(STDERR, "Unable to create migrations directory: $migrationsDir\n");
        exit(1);
    }
    echo "Created migrations directory: $migrationsDir\n";
}

$files = glob($migrationsDir . '/*.sql');
if ($files === false) {
    fwrite(STDERR, "Error scanning migration directory.\n");
    exit(1);
}
sort($files, SORT_STRING);

$appliedResult = $mysqli->query("SELECT migration FROM schema_migrations");
if ($appliedResult === false) {
    fwrite(STDERR, "Failed to read applied migrations: " . $mysqli->error . "\n");
    exit(1);
}
$applied = [];
while ($row = $appliedResult->fetch_assoc()) {
    $applied[$row['migration']] = true;
}

if (count($files) === 0) {
    echo "No migration files found in admin/migrations/.\n";
    exit(0);
}

/**
 * Split a SQL file into individual statements, stripping line comments.
 * Handles semicolons inside single-quoted strings so VALUES('a;b') won't split.
 */
function splitSql(string $sql): array {
    // Strip -- line comments
    $sql = preg_replace('/--[^\n]*/', '', $sql);
    // Strip # line comments
    $sql = preg_replace('/#[^\n]*/', '', $sql);

    $statements = [];
    $current    = '';
    $inString   = false;
    $strChar    = '';
    $len        = strlen($sql);

    for ($i = 0; $i < $len; $i++) {
        $ch = $sql[$i];

        if ($inString) {
            $current .= $ch;
            if ($ch === '\\') {
                // Escaped character — consume next char as-is
                if ($i + 1 < $len) { $current .= $sql[++$i]; }
            } elseif ($ch === $strChar) {
                $inString = false;
            }
        } else {
            if ($ch === "'" || $ch === '"' || $ch === '`') {
                $inString = true;
                $strChar  = $ch;
                $current .= $ch;
            } elseif ($ch === ';') {
                $trimmed = trim($current);
                if ($trimmed !== '') {
                    $statements[] = $trimmed;
                }
                $current = '';
            } else {
                $current .= $ch;
            }
        }
    }
    $trimmed = trim($current);
    if ($trimmed !== '') {
        $statements[] = $trimmed;
    }

    return $statements;
}

// MySQL error numbers that we treat as non-fatal warnings
// 1060 = Duplicate column name   (column already exists — idempotent ADD COLUMN)
// 1061 = Duplicate key name      (index already exists — idempotent ADD INDEX)
// 1091 = Can't DROP; doesn't exist (idempotent DROP COLUMN / DROP INDEX)
const IGNORABLE_ERRNOS = [1060, 1061, 1091];

foreach ($files as $path) {
    $name = basename($path);
    if (isset($applied[$name])) {
        echo "Skipping already applied migration: $name\n";
        continue;
    }

    echo "Applying migration: $name\n";
    $sql = file_get_contents($path);
    if ($sql === false) {
        fwrite(STDERR, "Failed to read migration file: $name\n");
        exit(1);
    }

    $statements = splitSql($sql);
    $failed     = false;

    foreach ($statements as $stmt) {
        if (!$mysqli->query($stmt)) {
            if (in_array($mysqli->errno, IGNORABLE_ERRNOS)) {
                echo "  ⚠  Skipped (already exists): " . $mysqli->error . "\n";
            } else {
                fwrite(STDERR, "  Migration failed ($name): " . $mysqli->error . "\n");
                fwrite(STDERR, "  Statement: " . substr($stmt, 0, 120) . "\n");
                $failed = true;
                break;
            }
        }
    }

    if ($failed) {
        exit(1);
    }

    $stmt2 = $mysqli->prepare("INSERT INTO schema_migrations (migration, applied_at) VALUES (?, NOW())");
    if ($stmt2 === false) {
        fwrite(STDERR, "Failed to prepare migration record insert: " . $mysqli->error . "\n");
        exit(1);
    }
    $stmt2->bind_param('s', $name);
    if (!$stmt2->execute()) {
        fwrite(STDERR, "Failed to record migration $name: " . $stmt2->error . "\n");
        exit(1);
    }
    $stmt2->close();
    echo "Successfully applied: $name\n";
}

echo "All available migrations are up to date.\n";
$mysqli->close();
