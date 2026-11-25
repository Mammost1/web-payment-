<?php
// Handles the login form: verifies the password hash with a prepared statement, then starts a session.
require __DIR__ . '/auth.php';
start_secure_session();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['username'], $_POST['password'])) {
    header('Location: index.php');
    exit;
}

if (!csrf_valid()) {
    csrf_reject('index.php');
}

include 'condb.php';

$username = trim((string) $_POST['username']);
$password = (string) $_POST['password'];

$row = null;
if ($username !== '' && $password !== '') {
    try {
        $stmt = mysqli_prepare($con, 'SELECT id, username, password_hash FROM login WHERE username = ? LIMIT 1');
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result) ?: null;
        mysqli_stmt_close($stmt);
    } catch (mysqli_sql_exception $e) {
        error_log('Login query failed: ' . $e->getMessage());
        http_response_code(500);
        exit('Something went wrong. Please try again later.');
    }
}

// A known user costs one bcrypt verify. For an unknown user do one bcrypt hash at the same cost,
// so the response time does not reveal whether the username exists.
if ($row !== null) {
    $ok = password_verify($password, $row['password_hash']);
} else {
    password_hash($password, PASSWORD_BCRYPT, ['cost' => WP_BCRYPT_COST]);
    $ok = false;
}

if ($ok) {
    session_regenerate_id(true);
    csrf_rotate();
    $_SESSION['id'] = (int) $row['id'];
    $_SESSION['username'] = $row['username'];
    header('Location: topup.php');
    exit;
}

echo '<script>';
echo 'alert("user หรือ password ไม่ถูกต้อง");';
echo 'window.history.back();';
echo '</script>';
