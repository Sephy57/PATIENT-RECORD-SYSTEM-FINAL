<?php

if (isset($_SESSION['user_id']) && in_array($_SESSION['user_type'] ?? '', ['patient', 'doctor', 'mrm', 'him'], true)) {
    $id = $params_data['id'];
    $patient_id = $_SESSION['user_id'];
    if ($_SESSION['user_type'] == 'patient') {
        $sql = "SELECT prescription FROM medical_records WHERE id = ? AND patient_id = ? AND archived = 0";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $id, $patient_id);
    } else {
        $sql = "SELECT prescription FROM medical_records WHERE id = ? AND archived = 0";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $pdfData);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($pdfData) {
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=Document.pdf");

        echo $pdfData;
    } else {
        header('Location: /');
    }
} else {
    header('Location: /');
}
