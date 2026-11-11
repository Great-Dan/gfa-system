<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <style>
    :root {
      --bg-dark: #0b1220;
      --primary: #0f766e;
      --primary-dark: #0b5c56;
      --text-dark: #1f2937;
      --muted: #64748b;
      --border: rgba(148, 163, 184, 0.25);
      --panel: rgba(255,255,255,0.92);
      --shadow: 0 18px 45px rgba(15, 23, 42, 0.28);
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      min-height: 100vh;
      display: grid;
      place-items: center;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background:
        radial-gradient(circle at top left, rgba(20, 184, 166, 0.16), transparent 35%),
        linear-gradient(135deg, #020817 0%, #0f172a 42%, #111827 100%);
      padding: 24px;
      color: var(--text-dark);
    }

    .card {
      width: min(100%, 460px);
      background: var(--panel);
      border: 1px solid var(--border);
      border-radius: 24px;
      padding: 30px 26px 24px;
      box-shadow: var(--shadow);
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 22px;
    }

    .logo {
      width: 56px;
      height: 56px;
      border-radius: 18px;
      overflow: hidden;
      background: linear-gradient(135deg, rgba(20,184,166,0.24), rgba(15,118,110,0.8));
      box-shadow: 0 12px 30px rgba(15, 118, 110, 0.22);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      border-radius: 18px;
    }

    .brand h1 {
      margin: 0;
      font-size: 1.6rem;
      letter-spacing: -0.04em;
      color: #0f172a;
    }

    .sub {
      margin: 0 0 20px;
      color: var(--muted);
      line-height: 1.6;
    }

    form {
      display: grid;
      gap: 16px;
    }

    .field {
      display: grid;
      gap: 8px;
    }

    label {
      font-size: 0.92rem;
      font-weight: 600;
      color: #334155;
    }

    input {
      width: 100%;
      border: 1px solid rgba(148, 163, 184, 0.6);
      border-radius: 12px;
      padding: 12px 13px;
      font-size: 1rem;
      color: #0f172a;
      background: rgba(255,255,255,0.9);
    }

    input:focus {
      outline: none;
      border-color: rgba(15, 118, 110, 0.9);
      box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.12);
    }

    .btn {
      border: none;
      border-radius: 12px;
      padding: 14px 18px;
      font-size: 1rem;
      font-weight: 700;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      cursor: pointer;
      box-shadow: 0 12px 30px rgba(15, 118, 110, 0.25);
      margin-top: 6px;
    }

    .footer {
      margin-top: 20px;
      text-align: center;
      font-size: 0.94rem;
      color: var(--muted);
    }

    .footer a {
      color: var(--primary-dark);
      text-decoration: none;
      font-weight: 700;
    }

    .success {
      background: #ecfdf5;
      border: 1px solid #bbf7d0;
      color: #166534;
      padding: 12px 14px;
      border-radius: 12px;
      margin-bottom: 16px;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="brand">
      <div class="logo">
        <img src="../images/gfa.jpg" alt="GFA logo">
      </div>
      <h1>Reset password</h1>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo '<div class="success">A password reset link has been sent to your email.</div>';
    }
    ?>

    <p class="sub">Enter your email address or username and we’ll send you instructions to reset your password.</p>

    <form method="post">
      <div class="field">
        <label for="email_or_username">Email or username</label>
        <input id="email_or_username" name="email_or_username" type="text" placeholder="Enter your email or username" required>
      </div>

      <button class="btn" type="submit">Send reset link</button>
    </form>

    <div class="footer">
      <a href="index.php">Back to sign in</a>
    </div>
  </div>
</body>
</html>
