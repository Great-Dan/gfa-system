<?php
$code = "592814";
$user = ['id' => 1];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Two-Factor Authentication</title>
  <style>
    :root {
      --bg-dark: #0b1220;
      --primary: #0f766e;
      --primary-dark: #0b5c56;
      --panel: rgba(255,255,255,0.94);
      --text: #0f172a;
      --muted: #64748b;
      --border: rgba(148, 163, 184, 0.25);
      --shadow: 0 22px 50px rgba(15, 23, 42, 0.18);
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      min-height: 100vh;
      display: grid;
      place-items: center;
      background:
        radial-gradient(circle at top left, rgba(20, 184, 166, 0.18), transparent 32%),
        linear-gradient(135deg, #020817 0%, #0f172a 42%, #111827 100%);
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      padding: 24px;
    }
    .card {
      width: min(100%, 440px);
      background: var(--panel);
      border: 1px solid var(--border);
      border-radius: 24px;
      box-shadow: var(--shadow);
      padding: 30px 26px 24px;
    }
    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 18px;
    }
    .logo {
      width: 52px;
      height: 52px;
      border-radius: 16px;
      overflow: hidden;
      background: linear-gradient(135deg, rgba(20,184,166,0.24), rgba(15,118,110,0.85));
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .logo img { width: 100%; height: 100%; object-fit: cover; display: block; }
    h1 {
      margin: 0;
      font-size: 1.7rem;
      letter-spacing: -0.04em;
      color: var(--text);
    }
    .sub {
      margin: 0 0 22px;
      color: var(--muted);
      line-height: 1.6;
      font-size: 0.96rem;
    }
    .otp-box {
      background: linear-gradient(180deg, #f8fafc, #eef6ff);
      border: 1px solid rgba(148, 163, 184, 0.35);
      border-radius: 16px;
      padding: 18px 16px;
      text-align: center;
      margin-bottom: 20px;
    }
    .otp-label {
      display: block;
      font-size: 0.76rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 8px;
    }
    .otp-code {
      display: inline-block;
      font-size: clamp(1.8rem, 4vw, 2.4rem);
      font-weight: 800;
      letter-spacing: 0.35em;
      color: var(--primary-dark);
    }
    form {
      display: grid;
      gap: 14px;
    }
    label {
      font-size: 0.92rem;
      font-weight: 600;
      color: #334155;
    }
    input {
      width: 100%;
      border: 1px solid rgba(148, 163, 184, 0.7);
      border-radius: 12px;
      padding: 14px 14px;
      font-size: 1.05rem;
      text-align: center;
      letter-spacing: 0.22em;
      background: rgba(255,255,255,0.9);
      color: var(--text);
    }
    input:focus {
      outline: none;
      border-color: rgba(15, 118, 110, 0.9);
      box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.12);
    }
    button {
      border: none;
      border-radius: 12px;
      padding: 14px 18px;
      font-size: 1rem;
      font-weight: 700;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      cursor: pointer;
      box-shadow: 0 12px 30px rgba(15, 118, 110, 0.22);
    }
    .note {
      margin-top: 16px;
      color: var(--muted);
      font-size: 0.85rem;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="brand">
      <div class="logo"><img src="../images/gfa.jpg" alt="GFA logo"></div>
      <h1>Verify OTP</h1>
    </div>

    <p class="sub">Enter the 6-digit verification code to complete your sign in.</p>

    <div class="otp-box">
      <span class="otp-label">Demo code (Two-Factor Authentication)</span>
      <span class="otp-code"><?php echo htmlspecialchars($code); ?></span>
    </div>

    <form method="post" action="../auth/verify_2fa.php">
      <input type="hidden" name="user_id" value="<?php echo (int)$user['id']; ?>">
      <label for="code">Enter 2FA code</label>
      <input id="code" name="code" value="592814" maxlength="6" inputmode="numeric" autocomplete="one-time-code" required>
      <button type="submit">Verify & Sign In</button>
    </form>

    <div class="note">Time-based OTP stored with bcrypt hash and 5-minute expiry.</div>
  </div>
</body>
</html>
