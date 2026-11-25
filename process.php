<?php
// Handles the registration form: validates the input, then stores the user with a hashed password.

function show_message(string $title, array $messages, string $backHref, int $status = 200): void
{
    http_response_code($status);
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><title>'
        . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</title></head><body><h3>'
        . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h3><ul>';
    foreach ($messages as $message) {
        echo '<li>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</li>';
    }
    echo '</ul><a href="' . htmlspecialchars($backHref, ENT_QUOTES, 'UTF-8') . '">Back</a></body></html>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

require __DIR__ . '/auth.php';
start_secure_session();
if (!csrf_valid()) {
    csrf_reject('register.php');
}

$username = trim((string) ($_POST['username'] ?? ''));
$password = (string) ($_POST['password'] ?? '');
$rePassword = (string) ($_POST['re_password'] ?? '');
$phone = trim((string) ($_POST['phone_number'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));

$errors = [];
// 1 to 50 characters; the /u flag also rejects text that is not valid UTF-8 (no mbstring needed).
if (!preg_match('/^.{1,50}$/su', $username)) {
    $errors[] = 'Username is required (up to 50 characters).';
}
if (strlen($password) < 8) {
    $errors[] = 'Password must be at least 8 characters.';
} elseif (strlen($password) > 72) {
    // bcrypt ignores everything after 72 bytes; refuse instead of silently truncating.
    $errors[] = 'Password must be at most 72 bytes.';
}
if ($password !== $rePassword) {
    $errors[] = 'The two passwords do not match.';
}
if (!preg_match('/^[0-9+\- ]{8,20}$/', $phone)) {
    $errors[] = 'Phone number is required (8-20 digits, may include + and -).';
}
if ($email === '' || strlen($email) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'A valid email address is required.';
}
if ($errors) {
    show_message('Registration failed', $errors, 'register.php', 400);
}

include 'condb.php';

$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => WP_BCRYPT_COST]);
try {
    $stmt = mysqli_prepare($con, 'INSERT INTO login (username, password_hash, phone_number, email) VALUES (?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'ssss', $username, $hash, $phone, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
} catch (mysqli_sql_exception $e) {
    if ((int) $e->getCode() === 1062) {
        show_message('Registration failed', ['That username is already taken. Please choose another one.'], 'register.php', 409);
    }
    error_log('Registration failed: ' . $e->getMessage());
    show_message('Registration failed', ['Something went wrong. Please try again later.'], 'register.php', 500);
}

header('Location: index.php');
exit;
