<?php
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/config.php';
$pdo = getPDO();
$users = $pdo->query("SELECT u.id, u.username, u.email, r.name AS role_name, u.password_hash, u.salt, u.created_at FROM users u JOIN roles r ON u.role_id=r.id")->fetchAll();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Database Architecture: Salt & Pepper</title>
<style>
  body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #0f172a; color: #f8fafc; padding: 30px; }
  .box { max-width: 1100px; margin: 0 auto; background: #1e293b; border-radius: 14px; border: 1px solid #334155; padding: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.4); }
  h2 { margin-top: 0; color: #38bdf8; display: flex; align-items: center; justify-content: space-between; }
  .badge { font-size: 0.85rem; padding: 4px 12px; background: #0284c7; color: white; border-radius: 9999px; }
  .config-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 24px; }
  .card { background: #0f172a; border: 1px solid #334155; border-radius: 10px; padding: 14px 18px; }
  .card b { color: #f59e0b; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 6px; }
  .card code { color: #34d399; font-size: 1rem; }
  table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 0.88rem; }
  th, td { padding: 12px; text-align: left; border-bottom: 1px solid #334155; }
  th { background: #0f172a; color: #94a3b8; text-transform: uppercase; font-size: 0.78rem; letter-spacing: 0.05em; }
  td code { color: #e2e8f0; background: #0f172a; padding: 3px 6px; border-radius: 6px; font-size: 0.82rem; }
  .salt { color: #f43f5e !important; font-weight: bold; }
  .hash { color: #a78bfa !important; font-size: 0.76rem; }
  .role { display: inline-block; padding: 2px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: bold; }
  .role-admin { background: rgba(239, 68, 68, 0.2); color: #f87171; }
  .role-president { background: rgba(59, 130, 246, 0.2); color: #60a5fa; }
  .role-captain { background: rgba(16, 185, 129, 0.2); color: #34d399; }
</style>
</head>
<body>
<div class="box">
  <h2>
    <span>Ghana Football Association MIS &bull; Database Cryptographic State</span>
    <span class="badge">Argon2id + Salt + Pepper</span>
  </h2>
  
  <div class="config-grid">
    <div class="card">
      <b>Global Server Pepper (Isolated in App Configuration)</b>
      <code>define('PASSWORD_PEPPER', 'GFA-DEMO-2026-Pepper');</code>
    </div>
    <div class="card">
      <b>Candidate Formula & Hashing Algorithm</b>
      <code>PASSWORD_PEPPER . $password . $salt &rarr; PASSWORD_ARGON2ID</code>
    </div>
  </div>

  <h3>Users Table Record Dump (`users`)</h3>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Per-User Salt (16-byte Hex)</th>
        <th>Argon2id Password Hash (with Salt & Pepper)</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $u): ?>
      <tr>
        <td><?= $u['id'] ?></td>
        <td><strong><?= htmlspecialchars($u['username']) ?></strong></td>
        <td><span class="role role-<?= htmlspecialchars($u['role_name']) ?>"><?= strtoupper(htmlspecialchars($u['role_name'])) ?></span></td>
        <td><code class="salt"><?= htmlspecialchars($u['salt']) ?></code></td>
        <td><code class="hash"><?= htmlspecialchars($u['password_hash']) ?></code></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
