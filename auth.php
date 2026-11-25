<?php
// Shared by every page that uses a session or hashes a password.

// One cost for registration and for the dummy work on failed logins, so both take the same time.
const WP_BCRYPT_COST = 12;

/** Starts the session with a hardened cookie: HttpOnly, SameSite=Lax, Secure when served over HTTPS. */
function start_secure_session(): void
{
    $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    ini_set('session.use_strict_mode', '1');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => $https,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

/** The session's CSRF token, created on first use. Call after start_secure_session(). */
function csrf_token(): string
{
    if (empty($_SESSION['csrf']) || !is_string($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

/** A hidden input holding the token, for every POST form. */
function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
}

/** True when the POSTed token matches the session's (constant-time comparison). */
function csrf_valid(): bool
{
    $given = $_POST['csrf_token'] ?? '';
    return is_string($given) && isset($_SESSION['csrf']) && is_string($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $given);
}

/** Replaces the token, e.g. after login. */
function csrf_rotate(): void
{
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

/** Stops the request with 403 and a clear message. */
function csrf_reject(string $backHref): void
{
    http_response_code(403);
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><title>Request rejected</title></head><body>'
        . '<h3>Request rejected</h3><p>The security token is missing or has expired. Please go back, reload the page and try again.</p>'
        . '<a href="' . htmlspecialchars($backHref, ENT_QUOTES, 'UTF-8') . '">Back</a></body></html>';
    exit;
}
