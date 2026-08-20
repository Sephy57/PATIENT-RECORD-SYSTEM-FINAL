<?php

$envFile = __DIR__ . '/../../.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        if (!array_key_exists($key, $_ENV) && getenv($key) === false) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

function env($key, $default = null)
{
    $value = getenv($key);
    return $value === false ? $default : $value;
}

$appEnv = env('APP_ENV', 'production');
$isProduction = $appEnv === 'production';

error_reporting(E_ALL);
ini_set('display_errors', $isProduction ? '0' : '1');
ini_set('log_errors', '1');

$host = env('DB_HOST', 'localhost');
$username = env('DB_USER');
$password = env('DB_PASSWORD');
$db = env('DB_NAME');

if ($username === null || $db === null) {
    die('Database configuration missing. Copy .env.example to .env and fill in DB_USER/DB_PASSWORD/DB_NAME.');
}

$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    error_log('DB connection failed: ' . mysqli_connect_error());
    die('Connection failed. Please try again later.');
}

require_once __DIR__ . '/../includes/security.php';
secure_session_start();
