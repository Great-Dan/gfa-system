# GFA (Ghana Football Association) Simple PHP + MySQL App

This is a minimal sample system demonstrating confidentiality, integrity and availability via:
- User identification (users table)
- Authorization by roles (`admin`, `president`, `captain`)
- Authentication with two-factor verification (one-time code)
- Password hashing using salt + pepper + Argon2
- Auto backup script (mysqldump) and backup logging

Setup steps (XAMPP on Windows):

1. Start XAMPP and MySQL.
2. Import the schema using phpMyAdmin or mysql CLI:

```bash
mysql -u root -p < gfa_schema.sql
```

3. Edit `src/config.php` and set `PASSWORD_PEPPER` to a secure random string.

4. Run the setup script to create sample users (once):

Open in browser: `http://localhost/SYSTEM/scripts/setup_users.php`

Or run in CLI from project folder:

```bash
php scripts/setup_users.php
```

Default sample users (for demo):
- username: `admin` password: `AdminPass123!`
- username: `president` password: `PresidentPass123!`
- username: `captain` password: `CaptainPass123!`

5. Put the project in your XAMPP `htdocs` or configure a virtual host so `public/index.php` is reachable.

6. Backups: to create a backup immediately run:

```bash
php scripts/backup.php
```

To auto-schedule backups on Windows use Task Scheduler to run the above command daily.

InfinityFree deployment notes:
- Upload the project files to your `public_html` folder.
- Set the MySQL values in your hosting control panel and keep the same `PASSWORD_PEPPER` value everywhere the app runs.
- For InfinityFree, use the DB host/user/password shown in your MySQL control panel instead of `localhost`/`root`.
- Make sure the app is reachable through `public/index.php`.
- The login page will show the 2FA code on the screen for demo purposes, and the admin credentials are the same default demo values.

Security notes:
- The app stores per-user random salts and uses a global `PASSWORD_PEPPER` (keep it outside webroot for production).
- 2FA code is displayed for demo; in production send it via email/SMS.
- Restrict access to `scripts/` in production or protect setup scripts.
