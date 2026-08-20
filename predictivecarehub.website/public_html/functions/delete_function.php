<?php

include '../config/index.php';

$actionRoles = [
    'delete_service' => ['it'],
    'delete_precaution' => ['him'],
    'delete_patient' => ['it'],
    'delete_physician' => ['it'],
    'delete_doctor' => ['it'],
    'delete_admin' => ['it'],
    'delete_medical' => ['it', 'mrm'],
    'archive_medical' => ['it', 'mrm'],
    'unarchive_medical' => ['it', 'mrm'],
    'remove_file' => ['it', 'mrm', 'doctor'],
    'remove_prescription' => ['it', 'mrm', 'doctor'],
    'delete_predictive_data' => ['him'],
];

if (isset($_POST['action']) && !csrf_verify()) {
    http_response_code(419);
    echo 'invalid_csrf';
    return;
}

if (isset($_POST['action']) && (!isset($actionRoles[$_POST['action']]) || !require_role($actionRoles[$_POST['action']]))) {
    if (!isset($actionRoles[$_POST['action']])) {
        http_response_code(400);
        echo 'unknown_action';
    }
    return;
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'delete_service') {
        $id = $_POST['id'];

        $sql = "DELETE FROM services WHERE service_id = ?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 's', $id);
            mysqli_stmt_execute($check);
            echo 'success';
        }
    } else if ($_POST['action'] == 'delete_precaution') {
        $id = $_POST['id'];

        $sql = "DELETE FROM precaution_information WHERE id = ?";
        $check = mysqli_prepare($conn, $sql);
        if ($check) {
            mysqli_stmt_bind_param($check, 's', $id);
            mysqli_stmt_execute($check);
            echo 'success';
        }
    } else if ($_POST['action'] == 'delete_patient') {
        $id = $_POST['id'];

        $sql = "DELETE FROM patients WHERE patient_id = ?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 's', $id);
            mysqli_stmt_execute($check);
            echo 'success';
        }
    } else if ($_POST['action'] == 'delete_physician') {
        $id = $_POST['id'];

        $sql = "DELETE FROM physicians WHERE physician_id = ?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 's', $id);
            mysqli_stmt_execute($check);
            echo 'success';
        }
    } else if ($_POST['action'] == 'delete_doctor') {
        $id = $_POST['id'];

        $sql = "DELETE FROM doctors WHERE doctor_id = ?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 's', $id);
            mysqli_stmt_execute($check);
            echo 'success';
        }
    } else if ($_POST['action'] == 'delete_admin') {
        $id = $_POST['id'];

        $sql = "DELETE FROM administrators WHERE admin_id = ?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 's', $id);
            mysqli_stmt_execute($check);
            echo 'success';
        }
    } else if ($_POST['action'] == 'delete_medical') {
        $id = $_POST['id'];

        $sql = "DELETE FROM medical_records WHERE id = ?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 'i', $id);
            mysqli_stmt_execute($check);
            echo 'success';
        }
    } else if ($_POST['action'] == 'archive_medical') {
        $id = $_POST['id'];

        $sql = "UPDATE medical_records SET archived=1 WHERE id=?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 'i', $id);
            if (mysqli_stmt_execute($check)) {
                echo 'success';
            }
        }
    } else if ($_POST['action'] == 'unarchive_medical') {
        $id = $_POST['id'];

        $sql = "UPDATE medical_records SET archived=0 WHERE id=?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 'i', $id);
            if (mysqli_stmt_execute($check)) {
                echo 'success';
            }
        }
    } else if ($_POST['action'] == 'remove_file') {
        $id = $_POST['id'];

        $sql = "UPDATE medical_records SET document=NULL WHERE id=?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 'i', $id);
            if (mysqli_stmt_execute($check)) {
                echo 'success';
            }
        }
    } else if ($_POST['action'] == 'remove_prescription') {
        $id = $_POST['id'];

        $sql = "UPDATE medical_records SET prescription=NULL WHERE id=?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 'i', $id);
            if (mysqli_stmt_execute($check)) {
                echo 'success';
            }
        }
    } else if ($_POST['action'] == 'delete_predictive_data') {
        $id = $_POST['id'];

        $sql = "DELETE FROM predictive_information WHERE id = ?";
        $check = mysqli_prepare($conn, $sql);

        if ($check) {
            mysqli_stmt_bind_param($check, 'i', $id);
            if (mysqli_stmt_execute($check)) {
                echo 'success';
            }
        }
    }
}
