<?php

date_default_timezone_set("Asia/Manila");
$currentTimestamp = date('Y-m-d H:i:s');

include '../config/index.php';
include 'random_uuid.php';
include 'send_mail.php';

use Ramsey\Uuid\Uuid;

require '../vendor/autoload.php';

$csrfExemptActions = ['login', 'login_admin', 'login_doctor', 'register'];

$actionRoles = [
    'add_admin' => ['it'],
    'add_doctor' => ['it'],
    'add_physician' => ['it'],
    'add_services' => ['it'],
    'add_precaution' => ['him'],
    'upload_file' => ['it', 'mrm', 'doctor'],
    'edit_file' => ['it', 'mrm', 'doctor'],
    'edit_prescription' => ['it', 'mrm', 'doctor'],
    'approve_request' => ['it'],
    'add_predictive_data' => ['him'],
];

if (isset($_POST['action']) && !in_array($_POST['action'], $csrfExemptActions, true) && !csrf_verify()) {
    http_response_code(419);
    echo 'invalid_csrf';
    return;
}

if (isset($_POST['action']) && isset($actionRoles[$_POST['action']]) && !require_role($actionRoles[$_POST['action']])) {
    return;
}

if (isset($_POST['action']) && $_POST['action'] == 'request_document') {
    $isOwnRole = ($_SESSION['user_type'] ?? null) === 'patient';
    $isSelf = ($_POST['patient_id'] ?? null) == ($_SESSION['user_id'] ?? null);
    if (!$isOwnRole || !$isSelf) {
        http_response_code(403);
        echo 'forbidden';
        return;
    }
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'register') {
        $firstname = mysqli_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_escape_string($conn, $_POST['lastname']);
        $number = mysqli_escape_string($conn, $_POST['number']);
        $email = mysqli_escape_string($conn, $_POST['email']);
        $birthday = mysqli_escape_string($conn, $_POST['birthday']);
        $age = mysqli_escape_string($conn, $_POST['age']);
        $gender = mysqli_escape_string($conn, $_POST['gender']);
        $address = mysqli_escape_string($conn, $_POST['address']);
        $password = mysqli_escape_string($conn, $_POST['password']);
        $weight = mysqli_escape_string($conn, $_POST['weight']);
        $height = mysqli_escape_string($conn, $_POST['height']);
        $bloodtype = mysqli_escape_string($conn, $_POST['bloodtype']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $random_uuid = random_uuid();

        $check_sql = "SELECT email FROM patients WHERE email = ?";
        $check = mysqli_prepare($conn, $check_sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 's', $email);
            mysqli_stmt_execute($check);
            $result = mysqli_stmt_get_result($check);
            $row = mysqli_fetch_array($result);
            if ($row) {
                echo 'exists';
                return;
            }
        }

        $sql = "INSERT INTO patients (firstname, lastname, number, email, birthday, age, gender, address, password, weight, height, bloodtype, signature) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssississsiiss', $firstname, $lastname, $number, $email, $birthday, $age, $gender, $address, $hashedPassword, $weight, $height, $bloodtype, $random_uuid);
            mysqli_stmt_execute($stmt);

            $check_sql2 = "SELECT patient_id, email FROM patients WHERE email = ?";
            $check2 = mysqli_prepare($conn, $check_sql2);
            mysqli_stmt_bind_param($check2, 's', $email);
            mysqli_stmt_execute($check2);
            $result2 = mysqli_stmt_get_result($check2);
            $row2 = mysqli_fetch_assoc($result2);

            if ($row2) {
                send($email, $random_uuid, $row2['patient_id']);
            }
        }
    } else if ($_POST['action'] == 'login') {
        $email = mysqli_escape_string($conn, $_POST['email']);
        $password = mysqli_escape_string($conn, $_POST['password']);

        if (!login_throttle_check('patient:' . $email)) {
            http_response_code(429);
            echo 'too_many_attempts';
            return;
        }

        $sql = "SELECT patient_id, email, password, user_type, account_verified FROM patients WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);

            if ($row) {
                if (password_verify($password, $row['password'])) {
                    if ($row['account_verified'] == 0) {
                        echo 'unverified';
                    } else {
                        login_throttle_reset('patient:' . $email);
                        session_regenerate_id(true);
                        $_SESSION['user_type'] = $row['user_type'];
                        $_SESSION['user_id'] = $row['patient_id'];
                        echo 'success';
                    }
                }
            }
        }
    } else if ($_POST['action'] == 'reverify') {
        $email = mysqli_escape_string($conn, $_POST['email']);
        $signature = random_uuid();
        $sql = "SELECT email, patient_id, account_verified FROM patients WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);

            if ($row) {
                if ($row['account_verified'] == 1) {
                    echo 'verified';
                } else {
                    $query = "UPDATE patients SET signature=?, updatedAt=? WHERE email=?";
                    $uStmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($uStmt, 'sss', $signature, $currentTimestamp, $email);
                    if (mysqli_stmt_execute($uStmt)) {
                        send($row['email'], $signature, $row['patient_id']);
                        echo 'success';
                    }
                }
            }
        }
    } else if ($_POST['action'] == 'forgot') {
        $email = mysqli_escape_string($conn, $_POST['email']);
        $signature = random_uuid();
        $sql = "SELECT email, patient_id, account_verified FROM patients WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);

            if ($row) {
                $query = "UPDATE patients SET signature=?, updatedAt=? WHERE email=?";
                $uStmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($uStmt, 'sss', $signature, $currentTimestamp, $email);
                if (mysqli_stmt_execute($uStmt)) {
                    forgot($row['email'], $signature, $row['patient_id']);
                    echo 'success';
                }
            }
        }
    } else if ($_POST['action'] == 'new_password') {
        $email = mysqli_escape_string($conn, $_POST['email'] ?? '');
        $signature = mysqli_escape_string($conn, $_POST['signature'] ?? '');
        $password = mysqli_escape_string($conn, $_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT patient_id, signature FROM patients WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);

        if (!$row || $row['signature'] === '-' || $signature === '' || !hash_equals($row['signature'], $signature)) {
            http_response_code(403);
            echo 'invalid_token';
            return;
        }

        $sql = "UPDATE patients SET password=?, signature='-', updatedAt=? WHERE patient_id=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sss', $hashedPassword, $currentTimestamp, $row['patient_id']);
            mysqli_stmt_execute($stmt);
            echo 'success';
        }
    } else if ($_POST['action'] == 'login_admin') {
        $username = mysqli_escape_string($conn, $_POST['username']);
        $password = mysqli_escape_string($conn, $_POST['password']);

        if (!login_throttle_check('admin:' . $username)) {
            http_response_code(429);
            echo 'too_many_attempts';
            return;
        }

        $sql = "SELECT admin_id, username, password, user_type FROM administrators WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);

            if ($row) {
                if (password_verify($password, $row['password'])) {
                    login_throttle_reset('admin:' . $username);
                    session_regenerate_id(true);
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['user_id'] = $row['admin_id'];
                    echo $row['user_type'];
                }
            }
        }
    } else if ($_POST['action'] == 'login_doctor') {
        $username = mysqli_escape_string($conn, $_POST['username']);
        $password = mysqli_escape_string($conn, $_POST['password']);

        if (!login_throttle_check('doctor:' . $username)) {
            http_response_code(429);
            echo 'too_many_attempts';
            return;
        }

        $sql = "SELECT doctor_id, username, password, user_type FROM doctors WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);

            if ($row) {
                if (password_verify($password, $row['password'])) {
                    login_throttle_reset('doctor:' . $username);
                    session_regenerate_id(true);
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['user_id'] = $row['doctor_id'];
                    echo 'success';
                }
            }
        }
    } else if ($_POST['action'] == 'add_admin') {
        $username = mysqli_escape_string($conn, $_POST['username']);
        $firstname = mysqli_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_escape_string($conn, $_POST['lastname']);
        $usertype = mysqli_escape_string($conn, $_POST['usertype']);
        $password = mysqli_escape_string($conn, $_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $uuid4 = Uuid::uuid4();
        $admin_id = $uuid4->toString();

        $check_sql = "SELECT username FROM administrators WHERE username = ?";
        $check = mysqli_prepare($conn, $check_sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 's', $username);
            mysqli_stmt_execute($check);
            $result = mysqli_stmt_get_result($check);
            $row = mysqli_fetch_array($result);

            if ($row) {
                echo 'exists';
                return;
            }
        }

        $sql = "INSERT INTO administrators (admin_id, firstname, lastname, username, password, user_type) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssssss', $admin_id, $firstname, $lastname, $username, $hashedPassword, $usertype);
            mysqli_stmt_execute($stmt);
            echo 'success';
        }
    } else if ($_POST['action'] == 'add_doctor') {
        $username = mysqli_escape_string($conn, $_POST['username']);
        $firstname = mysqli_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_escape_string($conn, $_POST['lastname']);
        $usertype = mysqli_escape_string($conn, $_POST['usertype']);
        $department = mysqli_escape_string($conn, $_POST['department']);
        $password = mysqli_escape_string($conn, $_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $uuid4 = Uuid::uuid4();
        $doctor_id = $uuid4->toString();

        $check_sql = "SELECT username FROM doctors WHERE username = ?";
        $check = mysqli_prepare($conn, $check_sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 's', $username);
            mysqli_stmt_execute($check);
            $result = mysqli_stmt_get_result($check);
            $row = mysqli_fetch_array($result);

            if ($row) {
                echo 'exists';
                return;
            }
        }
        
        $admin_id = $_SESSION['user_id'];

        $sql = "INSERT INTO doctors (admin_id, doctor_id, username, firstname, lastname, department, password, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssssssss', $admin_id, $doctor_id,  $username, $firstname, $lastname, $department, $hashedPassword, $usertype);
            mysqli_stmt_execute($stmt);
            echo 'success';
        }
    } else if ($_POST['action'] == 'add_physician') {
        $fullname = mysqli_escape_string($conn, $_POST['fullname']);
        $role = mysqli_escape_string($conn, $_POST['role']);
        $profile = file_get_contents($_FILES['profile']['tmp_name']);
        $admin_id = $_SESSION['user_id'];

        $sql = "INSERT INTO physicians (admin_id, physician_name, physician_role, physician_profile) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssss', $admin_id, $fullname,  $role, $profile);
            mysqli_stmt_execute($stmt);
            echo 'success';
        }
    } else if ($_POST['action'] == 'add_services') {
        $title = mysqli_escape_string($conn, $_POST['title']);
        $description = mysqli_escape_string($conn, $_POST['description']);
        $admin_id = $_SESSION['user_id'];

        $sql = "INSERT INTO services (admin_id, service_name, description) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sss', $admin_id, $title,  $description);
            mysqli_stmt_execute($stmt);
            echo 'success';
        }
    } else if ($_POST['action'] == 'add_precaution') {
        $title = mysqli_escape_string($conn, $_POST['title']);
        $description = mysqli_escape_string($conn, $_POST['description']);
        $admin_id = $_SESSION['user_id'];

        $sql = "INSERT INTO precaution_information (admin_id, title, description) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sss', $admin_id, $title,  $description);
            mysqli_stmt_execute($stmt);
            echo 'success';
        }
    } else if ($_POST['action'] == 'request_document') {
        $patient_id = mysqli_escape_string($conn, $_POST['patient_id']);
        $request_type = mysqli_escape_string($conn, $_POST['request_type']);
        $doctor_id = mysqli_escape_string($conn, $_POST['doctor_id']);
        $doctor_name = mysqli_escape_string($conn, $_POST['name']);
        $patient_name = mysqli_escape_string($conn, $_POST['patient_name']);

        $sql = "INSERT INTO medical_records (patient_id, patient_name, request_type, doctor_id, doctor_name) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sssss', $patient_id, $patient_name, $request_type, $doctor_id, $doctor_name);
            mysqli_stmt_execute($stmt);
        }
    } else if ($_POST['action'] == 'upload_file') {
        $id = mysqli_escape_string($conn, $_POST['id']);
        $document = file_get_contents($_FILES['file_document']['tmp_name']);

        $sql = "UPDATE medical_records SET document=?, uploaded=1, updatedAt='$currentTimestamp' WHERE id=?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 'si', $document, $id);
            if (mysqli_stmt_execute($check)) {
                echo 'success';
            }
        } else {
            echo "err";
        }
    } else if ($_POST['action'] == 'edit_file') {
        $id = mysqli_escape_string($conn, $_POST['edit_id']);
        $document = file_get_contents($_FILES['edit_document']['tmp_name']);

        $sql = "UPDATE medical_records SET document=?, updatedAt='$currentTimestamp' WHERE id=?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 'si', $document, $id);
            if (mysqli_stmt_execute($check)) {
                echo 'success';
            }
        } else {
            echo "err";
        }
    } else if ($_POST['action'] == 'edit_prescription') {
        $id = mysqli_escape_string($conn, $_POST['prescription_id']);
        $document = file_get_contents($_FILES['prescription']['tmp_name']);

        $sql = "UPDATE medical_records SET prescription=?, updatedAt='$currentTimestamp' WHERE id=?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 'si', $document, $id);
            if (mysqli_stmt_execute($check)) {
                echo 'success';
            }
        } else {
            echo "err";
        }
    } else if ($_POST['action'] == 'approve_request') {
        $id = mysqli_escape_string($conn, $_POST['id']);

        $sql = "UPDATE medical_records SET approved=1, updatedAt='$currentTimestamp' WHERE id=?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 'i', $id);
            if (mysqli_stmt_execute($check)) {
                echo 'success';
            }
        } else {
            echo "err";
        }
    } else if ($_POST['action'] == 'add_predictive_data') {
        $id = $_SESSION['user_id'];

        $month = mysqli_escape_string($conn, $_POST['month']);
        $year = mysqli_escape_string($conn, $_POST['year']);
        $data = json_encode($_POST['data']);

        $sql = "INSERT INTO predictive_information (admin_id, month, year, data) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'siis', $id, $month, $year, $data);
            if (mysqli_stmt_execute($stmt)) {
                echo 'success';
            }
        }
    }
}
