<?php
session_start();
$role = $_GET['role'] ?? 'admin';
$_SESSION['user'] = [
    'id' => ($role === 'admin' ? 1 : ($role === 'president' ? 2 : 3)),
    'username' => $role,
    'role_name' => $role,
    'role_id' => ($role === 'admin' ? 1 : ($role === 'president' ? 2 : 3))
];

if ($role === 'admin') {
    require __DIR__ . '/../pages/admin.php';
} elseif ($role === 'president') {
    require __DIR__ . '/../pages/president.php';
} elseif ($role === 'captain') {
    require __DIR__ . '/../pages/captain.php';
}
