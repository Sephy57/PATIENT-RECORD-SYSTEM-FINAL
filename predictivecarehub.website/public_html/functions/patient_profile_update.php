<?php

date_default_timezone_set("Asia/Manila");
include '../config/index.php';

$currentTimestamp = date('Y-m-d H:i:s');

if (!require_role(['patient'])) {
    return;
}

if (!csrf_verify()) {
    http_response_code(419);
    echo 'invalid_csrf';
    return;
}

$patientId = $_SESSION['user_id'];

if (isset($_POST['type'])) {
    if ($_POST['type'] == 'profile') {
        $firstname = mysqli_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_escape_string($conn, $_POST['lastname']);
        $email = mysqli_escape_string($conn, $_POST['email']);
        $birthday = mysqli_escape_string($conn, $_POST['birthday']);
        $age = mysqli_escape_string($conn, $_POST['age']);
        $gender = mysqli_escape_string($conn, $_POST['gender']);
        $address = mysqli_escape_string($conn, $_POST['address']);
        $weight = mysqli_escape_string($conn, $_POST['weight']);
        $height = mysqli_escape_string($conn, $_POST['height']);
        $bloodtype = mysqli_escape_string($conn, $_POST['bloodtype']);

        $sql = "UPDATE patients SET firstname=?, lastname=?, email=?, birthday=?, age=?, gender=?, address=?, weight=?, height=?, bloodtype=?, updatedAt=? WHERE patient_id=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssssissiisss', $firstname, $lastname, $email, $birthday, $age, $gender, $address, $weight, $height, $bloodtype, $currentTimestamp, $patientId);
            if (mysqli_stmt_execute($stmt)) {
                echo 1;
            }
        }
    } else if ($_POST['type'] == 'password') {
        $oldpass = mysqli_escape_string($conn, $_POST['oldpass']);
        $password = mysqli_escape_string($conn, $_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT patient_id, password FROM patients WHERE patient_id = ?";
        $check_stmt = mysqli_prepare($conn, $sql);


        if ($check_stmt) {
            mysqli_stmt_bind_param($check_stmt, 's', $patientId);
            mysqli_stmt_execute($check_stmt);
            $result = mysqli_stmt_get_result($check_stmt);
            $row = mysqli_fetch_array($result);

            if ($row) {
                if (password_verify($oldpass, $row['password'])) {

                    $query = "UPDATE patients SET password=?, updatedAt=? WHERE patient_id=?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, 'sss', $hashedPassword, $currentTimestamp, $patientId);
                    if (mysqli_stmt_execute($stmt)) {
                        echo 2;
                    }
                }
            }
        }
    }
}
