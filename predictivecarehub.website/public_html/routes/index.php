<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$url = "https://predictivecarehub.website";

$url .= $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
if (!empty($url_components['query'])) {
    parse_str($url_components['query'], $params);
}

$routes = [
    // public route
    '/' => 'views/home.php',
    '/register' => 'views/register.php',
    '/login' => 'views/login.php',
    '/legal/terms' => 'views/terms.php',

    // patient route
    '/patient' => 'views/patient/dashboard.php',
    '/patient/reports' => 'views/patient/reports.php',
    '/patient/account' => 'views/patient/account.php',

    // it staff route
    '/admin/it' => 'views/admin/it/dashboard.php',
    '/admin/patients' => 'views/admin/it/patients.php',
    '/admin/admins' => 'views/admin/it/administrators.php',
    '/admin/doctors' => 'views/admin/it/doctors.php',
    '/admin/physicians' => 'views/admin/it/physicians.php',
    '/admin/services' => 'views/admin/it/services.php',
    '/admin/approval' => 'views/admin/it/requests.php',

    // health information manager route
    '/admin/him' => 'views/admin/him/dashboard.php',
    '/admin/predictive' => 'views/admin/him/predictive.php',
    '/admin/precaution' => 'views/admin/him/precaution.php',

    // medical record manager route
    '/admin/mrm' => 'views/admin/mrm/dashboard.php',
    '/admin/requests' => 'views/admin/mrm/requests.php',
    '/admin/records' => 'views/admin/mrm/records.php',
    '/admin/archive' => 'views/admin/mrm/archive.php',

    // admin login route
    '/admin' => 'views/admin/login.php',

    // doctor route
    '/doctor' => 'views/doctor/login.php',
    '/doctor/dashboard' => 'views/doctor/dashboard.php',
    '/doctor/prescribe' => 'views/doctor/prescribe.php',

    //logout
    '/logout' => 'functions/logout.php',

    //verify
    '/verify' => 'views/verify.php',
    '/reverify' => 'views/reverify.php',
    '/forgot' => 'views/forgot.php',
    '/reset' => 'views/reset.php',

    //view pdf
    '/view/document' => 'functions/view_medical.php',
    '/view/prescription' => 'functions/view_prescription.php',
    '/download/medical' => 'functions/download_medical.php',
    '/download/prescription' => 'functions/download_prescription.php',
];

if (array_key_exists($uri, $routes)) {
    if (!empty($params)) {
        $params_data = $params;
    }
    require $routes[$uri];
} else {
    require 'views/404/404.php';
}
