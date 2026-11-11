<?php
require_once __DIR__ . '/../src/config.php';
// This script saves a mysqldump file into BACKUP_DIR and logs it in the DB.

if (!is_dir(BACKUP_DIR)) mkdir(BACKUP_DIR, 0755, true);

$timestamp = (new DateTime())->format('Ymd_His');
$filename = "gfa_backup_{$timestamp}.sql";
$path = BACKUP_DIR . DIRECTORY_SEPARATOR . $filename;

// Adjust path to mysqldump if needed. On XAMPP windows default:
$mysqldump = '"C:\\xampp\\mysql\\bin\\mysqldump.exe"';
$cmd = "$mysqldump -h " . DB_HOST . " -u " . DB_USER . " " . DB_NAME . " > " . escapeshellarg($path);

exec($cmd, $out, $rc);
if ($rc !== 0) {
    echo "Backup failed (rc=$rc). Command: $cmd";
    exit(1);
}

// log in DB
try {
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('INSERT INTO backups (filename) VALUES (?)');
    $stmt->execute([$filename]);
} catch (Exception $e) {
    // still ok, file exists
}

echo "Backup created: $path\n";
