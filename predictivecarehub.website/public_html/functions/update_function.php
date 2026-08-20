<?php

date_default_timezone_set("Asia/Manila");
include '../config/index.php';

$currentTimestamp = date('Y-m-d H:i:s');

$actionRoles = [
    'update_admin' => ['it'],
    'update_doctor' => ['it'],
    'edit_physician' => ['it'],
    'edit_services' => ['it'],
    'edit_precaution' => ['him'],
    'edit_predictive_data' => ['him'],
    'select_data' => ['him'],
];

if (isset($_POST['action']) && !csrf_verify()) {
    http_response_code(419);
    echo 'invalid_csrf';
    return;
}

if (isset($_POST['action']) && isset($actionRoles[$_POST['action']]) && !require_role($actionRoles[$_POST['action']])) {
    return;
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'update_admin') {
        $username = mysqli_escape_string($conn, $_POST['username']);
        $firstname = mysqli_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_escape_string($conn, $_POST['lastname']);
        $usertype = mysqli_escape_string($conn, $_POST['usertype']);
        $password = mysqli_escape_string($conn, $_POST['password']);
        $id = $_POST['id'];

        $checkStmt = mysqli_prepare($conn, "SELECT admin_id, username FROM administrators WHERE username = ?");
        mysqli_stmt_bind_param($checkStmt, 's', $username);
        mysqli_stmt_execute($checkStmt);
        $result = mysqli_stmt_get_result($checkStmt);
        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                if ($row['admin_id'] == $id) {
                    if (empty($password)) {
                        $sql = "UPDATE administrators SET firstname=?, lastname=?, username=?, user_type=?, updatedAt='$currentTimestamp' WHERE admin_id=?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 'sssss', $firstname, $lastname, $username, $usertype, $id);
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "UPDATE administrators SET firstname=?, lastname=?, username=?, user_type=?, password=?, updatedAt='$currentTimestamp' WHERE admin_id=?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 'ssssss', $firstname, $lastname, $username, $usertype, $hashedPassword, $id);
                    }

                    if (mysqli_stmt_execute($stmt)) {
                        echo 'success';
                    }
                } else {
                    echo 'exists';
                }
            } else {
                if (empty($password)) {
                    $sql = "UPDATE administrators SET firstname=?, lastname=?, username=?, user_type=?, updatedAt='$currentTimestamp' WHERE admin_id=?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'sssss', $firstname, $lastname, $username, $usertype, $id);
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "UPDATE administrators SET firstname=?, lastname=?, username=?, user_type=?, password=?, updatedAt='$currentTimestamp' WHERE admin_id=?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'ssssss', $firstname, $lastname, $username, $usertype, $hashedPassword, $id);
                }

                if (mysqli_stmt_execute($stmt)) {
                    echo 'success';
                }
            }
        }
    } else if ($_POST['action'] == 'update_doctor') {
        $username = mysqli_escape_string($conn, $_POST['username']);
        $firstname = mysqli_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_escape_string($conn, $_POST['lastname']);
        $department = mysqli_escape_string($conn, $_POST['department']);
        $password = mysqli_escape_string($conn, $_POST['password']);
        $id = $_POST['id'];

        $checkStmt = mysqli_prepare($conn, "SELECT doctor_id, username FROM doctors WHERE username = ?");
        mysqli_stmt_bind_param($checkStmt, 's', $username);
        mysqli_stmt_execute($checkStmt);
        $result = mysqli_stmt_get_result($checkStmt);
        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                if ($row['doctor_id'] == $id) {
                    if (empty($password)) {
                        $sql = "UPDATE doctors SET firstname=?, lastname=?, username=?, department=?, updatedAt='$currentTimestamp' WHERE doctor_id=?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 'sssss', $firstname, $lastname, $username, $department, $id);
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "UPDATE doctors SET firstname=?, lastname=?, username=?, department=?, password=?, updatedAt='$currentTimestamp' WHERE doctor_id=?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 'ssssss', $firstname, $lastname, $username, $department, $hashedPassword, $id);
                    }

                    if (mysqli_stmt_execute($stmt)) {
                        $fullname = $firstname . " " . $lastname;
                        $docNameStmt = mysqli_prepare($conn, "UPDATE medical_records SET doctor_name=?, updatedAt=? WHERE doctor_id=?");
                    mysqli_stmt_bind_param($docNameStmt, 'sss', $fullname, $currentTimestamp, $id);
                    mysqli_stmt_execute($docNameStmt);
                        echo 'success';
                    }
                } else {
                    echo 'exists';
                }
            } else {
                if (empty($password)) {
                    $sql = "UPDATE doctors SET firstname=?, lastname=?, username=?, department=?, updatedAt='$currentTimestamp' WHERE doctor_id=?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'sssss', $firstname, $lastname, $username, $department, $id);
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "UPDATE doctors SET firstname=?, lastname=?, username=?, department=?, password=?, updatedAt='$currentTimestamp' WHERE doctor_id=?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'ssssss', $firstname, $lastname, $username, $department, $hashedPassword, $id);
                }

                if (mysqli_stmt_execute($stmt)) {
                    $fullname = $firstname . " " . $lastname;
                    $docNameStmt = mysqli_prepare($conn, "UPDATE medical_records SET doctor_name=?, updatedAt=? WHERE doctor_id=?");
                    mysqli_stmt_bind_param($docNameStmt, 'sss', $fullname, $currentTimestamp, $id);
                    mysqli_stmt_execute($docNameStmt);
                    echo 'success';
                }
            }
        }
    } else if ($_POST['action'] == 'edit_physician') {
        $fullname = mysqli_escape_string($conn, $_POST['fullname']);
        $role = mysqli_escape_string($conn, $_POST['role']);
        $id = $_POST['id'];

        if ($_FILES['profile']['error'] == UPLOAD_ERR_NO_FILE) {
            $sql = "UPDATE physicians SET physician_name=?, physician_role=?, updatedAt='$currentTimestamp' WHERE physician_id=?";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ssss', $fullname, $role, $id);
                mysqli_stmt_execute($stmt);
                echo 'success';
            }
        } else {
            $profile = file_get_contents($_FILES['profile']['tmp_name']);
            $sql = "UPDATE physicians SET physician_name=?, physician_role=?, physician_profile=?, updatedAt='$currentTimestamp' WHERE physician_id=?";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ssss', $fullname, $role, $profile, $id);
                mysqli_stmt_execute($stmt);
                echo 'success';
            }
        }
    } else if ($_POST['action'] == 'edit_services') {
        $title = mysqli_escape_string($conn, $_POST['title']);
        $description = mysqli_escape_string($conn, $_POST['description']);
        $id = $_POST['id'];

        $sql = "UPDATE services SET service_name=?, description=?, updatedAt='$currentTimestamp' WHERE service_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sss', $title, $description, $id);
            mysqli_stmt_execute($stmt);
            echo 'success';
        }
    }  else if ($_POST['action'] == 'edit_precaution') {
        $title = mysqli_escape_string($conn, $_POST['title']);
        $description = mysqli_escape_string($conn, $_POST['description']);
        $id = $_POST['id'];

        $sql = "UPDATE precaution_information SET title=?, description=?, updatedAt='$currentTimestamp' WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sss', $title, $description, $id);
            mysqli_stmt_execute($stmt);
            echo 'success';
        }
    } else if ($_POST['action'] == 'edit_predictive_data') {
        $id = $_POST['id'];
        $month = mysqli_escape_string($conn, $_POST['month']);
        $year = mysqli_escape_string($conn, $_POST['year']);
        $data = json_encode($_POST['data']);

        $sql = "UPDATE predictive_information SET month=?, year=?, data=?, updatedAt='$currentTimestamp' WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'iiss', $month, $year, $data,  $id);
            if (mysqli_stmt_execute($stmt)) {
                echo 'success';
            }
        }
    } else if ($_POST['action'] == 'select_data') {
        $id = $_POST['id'];

        mysqli_query($conn, "UPDATE predictive_information SET selected=0");

        $sql = "UPDATE predictive_information SET selected=1, updatedAt='$currentTimestamp' WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $id);
            if (mysqli_stmt_execute($stmt)) {
                echo 'success';
            }
        }
    }
}
