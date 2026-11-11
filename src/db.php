<?php
require_once __DIR__ . '/config.php';

function getPDO(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $port = defined('DB_PORT') ? DB_PORT : (getenv('DB_PORT') ?: '3306');
    $ssl = getenv('DB_SSL') ?: (defined('DB_SSL') ? DB_SSL : false);

    $dsn = 'mysql:host=' . DB_HOST . ';port=' . $port . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    if ($ssl && ($ssl === true || $ssl === 'true' || $ssl === '1')) {
        $caPaths = [
            '/etc/ssl/certs/ca-certificates.crt',
            '/etc/pki/tls/certs/ca-bundle.crt',
            '/etc/ssl/cert.pem',
            'C:/xampp/apache/bin/curl-ca-bundle.crt',
            'C:/xampp/php/extras/ssl/cacert.pem',
        ];
        foreach ($caPaths as $ca) {
            if (file_exists($ca)) {
                $options[PDO::MYSQL_ATTR_SSL_CA] = $ca;
                break;
            }
        }
        $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = true;
    }

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        if (getenv('VERCEL') !== false && (DB_HOST === '127.0.0.1' || DB_HOST === 'localhost')) {
            die('<h3>Database connection required</h3><p>This deployment is running on Vercel serverless. Please configure your remote MySQL database environment variables (DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT) in the Vercel project dashboard.</p><p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>');
        }
        die('DB connection failed: ' . $e->getMessage());
    }
}
