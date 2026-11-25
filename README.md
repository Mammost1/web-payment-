# web-payment-

A small PHP + MySQL site for a game-server community (Rust / WarZ): member registration, login,
a download link, a Discord link, and a TrueMoney top-up page.

**The top-up form is a UI mock.** It has no payment backend: the "top up" button only shows an alert
and nothing is charged or stored.

2022 practice project, security fixes applied in 2026 (hashed passwords, prepared statements,
sessions, output escaping, validation, no secrets in the repository).

## Run locally

Needs PHP 8 with the `mysqli` extension and MySQL or MariaDB.

1. Create the database and table: `mysql -u <user> -p < schema.sql`
2. Configure the connection, either with environment variables
   `DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME`, or by copying `config.example.php` to `config.php`
   (gitignored) and editing it. Environment variables win.
3. Start PHP's built-in server from this folder: `php -S localhost:8000`
4. Open http://localhost:8000/register.php, register, then log in at http://localhost:8000/index.php.

## Notes

- Passwords are stored with `password_hash()` and checked with `password_verify()`; they must be
  8 to 72 bytes long (bcrypt ignores anything past 72).
- Never commit `config.php` or `.env`.
- Protected: SQL injection (prepared statements everywhere), XSS (output escaped), session fixation
  (`session_regenerate_id` on login, strict mode), session cookie theft (HttpOnly, SameSite=Lax,
  Secure over HTTPS), CSRF on register, login and logout (per-session token from `random_bytes`,
  checked with `hash_equals`, rotated after login), user enumeration by timing (equal bcrypt work
  for unknown users).
- Known limits: no rate limiting or account lockout (a login can be tried again and again), no
  email verification, no password reset, and the top-up page is a mock. Put it behind HTTPS and a
  rate limiter before using it for real.

## Testing status

The 2026 security fixes were reviewed by reading the code. They have not yet been run against a live PHP and MySQL setup (`php -l` and a register, login and logout pass are still to do).
