<?php
// Ends the session and removes its cookie. POST with a valid CSRF token only: a link, an image or
// another site cannot log someone out.
require __DIR__ . '/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    start_secure_session();
    if (!csrf_valid()) {
        csrf_reject('index.php');
    }
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires'  => time() - 42000,
            'path'     => $p['path'],
            'domain'   => $p['domain'],
            'secure'   => $p['secure'],
            'httponly' => $p['httponly'],
            'samesite' => $p['samesite'],
        ]);
    }
    session_destroy();
}
header('Location: index.php');
exit;
