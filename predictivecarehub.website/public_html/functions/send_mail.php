<?php

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

require_once __DIR__ . '/../includes/security.php';

function mailer()
{
    require_once __DIR__ . '/../vendor/autoload.php';
    $dsn = env('MAIL_DSN');
    if (!$dsn) {
        throw new RuntimeException('MAIL_DSN is not configured. Set it in .env.');
    }
    return new Mailer(Transport::fromDsn($dsn));
}

function mail_from()
{
    return env('MAIL_FROM', 'no-reply@predictivecarehub.website');
}

function app_url()
{
    return rtrim(env('APP_URL', 'https://predictivecarehub.website'), '/');
}

function send($email, $random_uuid, $patient_id)
{
    $link = app_url() . '/verify?email=' . urlencode($email) . '&signature=' . urlencode($random_uuid);

    $message = "
            <h1>Thank you for Registering.</h1>
            <p>Your Account:</p>
            <p><b>Patient ID: " . e($patient_id) . "</b></p>
            <p><b>Email: </b>" . e($email) . "</p>
            <a style='background-color: skyblue; padding: 10px 20px; border-radius: 5px; text-decoration: none; color: black;' href='" . e($link) . "'>Verify Account</a>
            <p><b>or</b></p>
            <p>Click the link below to verify your account.</p>
            <a href='" . e($link) . "'>" . e($link) . "</a>
            <h3><b>&copy; PredictiveCare Hub<b></p>
        ";

    $mail = (new Email())
        ->from(mail_from())
        ->to($email)
        ->subject('Account Verification')
        ->html($message);

    mailer()->send($mail);
}

function forgot($email, $random_uuid, $patient_id)
{
    $link = app_url() . '/reset?email=' . urlencode($email) . '&signature=' . urlencode($random_uuid);

    $message = "
            <h1>Reset Your Password.</h1>
            <p>Your Account:</p>
            <p><b>Patient ID: " . e($patient_id) . "</b></p>
            <p><b>Email: </b>" . e($email) . "</p>
            <a style='background-color: skyblue; padding: 10px 20px; border-radius: 5px; text-decoration: none; color: black;' href='" . e($link) . "'>Change Password</a>
            <p><b>or</b></p>
            <p>Click the link below to verify your account.</p>
            <a href='" . e($link) . "'>" . e($link) . "</a>
            <h3><b>&copy; PredictiveCare Hub<b></p>
        ";

    $mail = (new Email())
        ->from(mail_from())
        ->to($email)
        ->subject('Password Reset')
        ->html($message);

    mailer()->send($mail);
}

function contact($email, $mes, $name)
{
    $message = "
            <h1>Inquiry</h1>
            <p><b>Name: " . e($name) . "</b></p>
            <p><b>Email: </b>" . e($email) . "</p>
            <p><b>Message: </b>" . nl2br(e($mes)) . "</p>
            <h3><b>&copy; PredictiveCare Hub<b></p>
        ";

    $mail = (new Email())
        ->from(mail_from())
        ->to(mail_from())
        ->replyTo($email)
        ->subject('Contact Us')
        ->html($message);

    mailer()->send($mail);
}
