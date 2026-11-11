<?php
session_start();
require_once __DIR__ . '/../src/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/index.php');
    exit;
}

$user_id = (int)($_POST['user_id'] ?? 0);
$code = $_POST['code'] ?? '';

$pdo = getPDO();
$stmt = $pdo->prepare('SELECT * FROM two_factor_codes WHERE user_id = ? ORDER BY id DESC LIMIT 1');
$stmt->execute([$user_id]);
$row = $stmt->fetch();
if (!$row) die('No 2FA code found');

if (new DateTime() > new DateTime($row['expires_at'])) {
    die('2FA code expired');
}

if (!password_verify($code, $row['code_hash'])) {
    die('Invalid 2FA code');
}

// 2FA ok -> load user and create session
$stmt = $pdo->prepare('SELECT u.*, r.name AS role_name FROM users u JOIN roles r ON u.role_id=r.id WHERE u.id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch();
if (!$user) die('User not found');

// set session with minimal user info
$_SESSION['user'] = [
    'id' => $user['id'],
    'username' => $user['username'],
    'role_id' => $user['role_id'],
    'role_name' => $user['role_name']
];

header('Location: ../pages/' . $user['role_name'] . '.php');
exit;
