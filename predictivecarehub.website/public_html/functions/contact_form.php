<?php

include 'send_mail.php';

$message = trim($_POST['message'] ?? '');
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');

if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo 'invalid_input';
    return;
}

contact($email, $message, $name);
echo 'success';
