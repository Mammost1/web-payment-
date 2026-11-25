<?php
// Database connection. Credentials come from environment variables (DB_HOST, DB_USER,
// DB_PASSWORD, DB_NAME) or from a local config.php that is not committed (see config.example.php).
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbConfig = is_file(__DIR__ . '/config.php') ? require __DIR__ . '/config.php' : [];
$dbSetting = function (string $env, string $key, string $default) use ($dbConfig): string {
    $value = getenv($env);
    if ($value !== false && $value !== '') {
        return $value;
    }
    return isset($dbConfig[$key]) ? (string) $dbConfig[$key] : $default;
};

try {
    $con = mysqli_connect(
        $dbSetting('DB_HOST', 'host', 'localhost'),
        $dbSetting('DB_USER', 'user', ''),
        $dbSetting('DB_PASSWORD', 'password', ''),
        $dbSetting('DB_NAME', 'name', 'login_db')
    );
    mysqli_set_charset($con, 'utf8mb4');
} catch (mysqli_sql_exception $e) {
    // The message can name the host and user: keep it in the server log, not in the page.
    error_log('Database connection failed: ' . $e->getMessage());
    http_response_code(500);
    exit('Database unavailable. Check the configuration (see README).');
}
