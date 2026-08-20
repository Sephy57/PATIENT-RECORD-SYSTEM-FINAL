<?php

include '../config/index.php';

header('Content-Type: application/json');

if (!csrf_verify()) {
    http_response_code(419);
    echo json_encode(['error' => 'Invalid request. Please refresh the page and try again.']);
    return;
}

if (!login_throttle_check('chatbot:' . session_id(), 20, 60)) {
    http_response_code(429);
    echo json_encode(['error' => 'Too many messages. Please wait a moment before trying again.']);
    return;
}

$message = trim($_POST['message'] ?? '');

if ($message === '' || mb_strlen($message) > 1000) {
    http_response_code(422);
    echo json_encode(['error' => 'Please enter a message under 1000 characters.']);
    return;
}

$apiKey = env('GEMINI_API_KEY');
if (!$apiKey) {
    http_response_code(503);
    echo json_encode(['error' => 'The assistant is not configured yet. Please contact IT support.']);
    return;
}

// Keep a short rolling history per session so the assistant has context,
// capped to limit token usage and session storage growth.
if (!isset($_SESSION['chatbot_history']) || !is_array($_SESSION['chatbot_history'])) {
    $_SESSION['chatbot_history'] = [];
}

$_SESSION['chatbot_history'][] = ['role' => 'user', 'parts' => [['text' => $message]]];
$_SESSION['chatbot_history'] = array_slice($_SESSION['chatbot_history'], -12);

$systemInstruction = <<<'TXT'
You are the help assistant for PredictiveCareHub, a hospital patient record system website.
Your ONLY job is to help users understand how to use this website: registering an account,
logging in, verifying an email, resetting a password, requesting medical documents or
prescriptions, navigating the patient/doctor/admin dashboards, and understanding what each
staff role (IT, Health Information Manager, Medical Record Manager, Doctor) can do here.

Strict rules:
- Never provide medical, diagnostic, treatment, or medication advice of any kind, even if asked.
  If a user asks a medical question, reply that you can only help with using the website and
  that they should contact their doctor or hospital staff directly for medical concerns.
- Never ask for or repeat back passwords, full document contents, or other sensitive personal data.
- If you don't know how a specific feature works, say so plainly instead of guessing.
- Keep answers short, plain-language, and specific to this website's features.
- Formatting: plain text only. Do not use markdown headings or tables. You may use
  "**word**" for a single emphasized word/phrase and simple numbered ("1. ", "2. ")
  or dashed ("- ") lists on their own lines when steps are involved. Keep lists short.
TXT;

$requestBody = [
    'system_instruction' => [
        'parts' => [['text' => $systemInstruction]],
    ],
    'contents' => $_SESSION['chatbot_history'],
    'generationConfig' => [
        'temperature' => 0.3,
        'maxOutputTokens' => 400,
    ],
];

$model = env('GEMINI_MODEL', 'gemini-flash-lite-latest');
$url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . urlencode($apiKey);

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode($requestBody),
    CURLOPT_TIMEOUT => 20,
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($curlError || $httpCode !== 200) {
    error_log('Gemini API error: ' . $curlError . ' HTTP ' . $httpCode . ' ' . $response);
    http_response_code(502);
    echo json_encode(['error' => 'The assistant is temporarily unavailable. Please try again shortly.']);
    return;
}

$data = json_decode($response, true);
$reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

if (!$reply) {
    http_response_code(502);
    echo json_encode(['error' => 'The assistant could not generate a response. Please try again.']);
    return;
}

$_SESSION['chatbot_history'][] = ['role' => 'model', 'parts' => [['text' => $reply]]];
$_SESSION['chatbot_history'] = array_slice($_SESSION['chatbot_history'], -12);

echo json_encode(['reply' => $reply]);
