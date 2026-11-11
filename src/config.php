<?php
// Database configuration
// Use environment variables on shared hosts (InfinityFree/cPanel) when present.
define('DB_HOST', getenv('DB_HOST') ?: getenv('DB_SERVER') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'system');
define('DB_USER', getenv('DB_USER') ?: getenv('DB_USERNAME') ?: 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : (getenv('DB_PASSWORD') ?: ''));

// Application-wide pepper.
// For local dev this default is intentionally stable so the demo users work out of the box.
// On production, set the same value in the hosting environment and do not change it after users exist.
define('PASSWORD_PEPPER', getenv('PASSWORD_PEPPER') ?: getenv('APP_PASSWORD_PEPPER') ?: 'GFA-DEMO-2026-Pepper');

define('PASSWORD_PEPPER_FALLBACKS', json_encode([
    'CHANGE_THIS_PEPPER_TO_A_RANDOM_STRING',
    'GFA-DEMO-2026-Pepper',
]));

// 2FA settings
define('TWO_FACTOR_EXPIRY_MINUTES', 5);

// Backup location (relative to project)
define('BACKUP_DIR', __DIR__ . '/../backups');

function buildPasswordCandidate(string $password, string $salt): string
{
    return PASSWORD_PEPPER . $password . $salt;
}

function hashPasswordWithPepper(string $password, string $salt): string
{
    return password_hash(buildPasswordCandidate($password, $salt), PASSWORD_ARGON2ID);
}

function verifyStoredPassword(string $password, string $salt, string $storedHash): bool
{
    $pepperValues = [PASSWORD_PEPPER];
    $fallbacks = json_decode(PASSWORD_PEPPER_FALLBACKS, true);
    if (is_array($fallbacks)) {
        $pepperValues = array_values(array_unique(array_merge($pepperValues, $fallbacks)));
    }

    foreach ($pepperValues as $pepper) {
        if ($pepper === '') {
            continue;
        }

        if (password_verify($pepper . $password . $salt, $storedHash)) {
            return true;
        }
    }

    return false;
}
?>
