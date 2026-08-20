
<?php

include '../config/index.php';
if (isset($_SESSION['user_id'])) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="document.pdf"');

    $id = $_GET['id'];
    $filename = preg_replace('/[^A-Za-z0-9 _-]/', '', $_GET['filename'] ?? 'document');
    $patient_id = $_SESSION['user_id'];

    $sql = "SELECT document FROM medical_records WHERE id = ? AND patient_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "is", $id, $patient_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $pdfData);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($pdfData) {
        header("Content-type: application/pdf");
        header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');

        echo $pdfData;
    } else {
        header('Location: /');
    }
} else {
    header('Location: /');
}

?>