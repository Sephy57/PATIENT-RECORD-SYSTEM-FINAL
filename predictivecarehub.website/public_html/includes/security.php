<?php

function secure_session_start()
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    session_start();
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_field()
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_verify()
{
    $submitted = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['csrf_token'] ?? '');

    if (empty($_SESSION['csrf_token']) || empty($submitted)) {
        return false;
    }

    return hash_equals($_SESSION['csrf_token'], $submitted);
}

/**
 * Simple per-identifier login throttle backed by the session.
 * Not distributed/persistent across sessions by design (no extra DB table
 * in the original schema) — blocks rapid-fire brute force from one session,
 * pair with server/proxy-level rate limiting for full protection.
 */
function login_throttle_check($identifierKey, $maxAttempts = 5, $lockoutSeconds = 60)
{
    $bucket = $_SESSION['login_throttle'][$identifierKey] ?? ['count' => 0, 'first' => time()];

    if (time() - $bucket['first'] > $lockoutSeconds) {
        $bucket = ['count' => 0, 'first' => time()];
    }

    if ($bucket['count'] >= $maxAttempts) {
        $_SESSION['login_throttle'][$identifierKey] = $bucket;
        return false;
    }

    $bucket['count']++;
    $_SESSION['login_throttle'][$identifierKey] = $bucket;
    return true;
}

function login_throttle_reset($identifierKey)
{
    unset($_SESSION['login_throttle'][$identifierKey]);
}

/**
 * Returns true and lets the caller proceed if the current session's
 * user_type is in $allowedRoles. Otherwise emits a 403 and returns false —
 * caller must `return`/`exit` immediately when this returns false.
 */
function require_role(array $allowedRoles)
{
    $role = $_SESSION['user_type'] ?? null;

    if ($role === null || !in_array($role, $allowedRoles, true)) {
        http_response_code(403);
        echo 'forbidden';
        return false;
    }

    return true;
}
