<?php
include '../config/index.php';

if (isset($_GET['id'])) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM predictive_information WHERE id=? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
} else {
    $stmt = mysqli_prepare($conn, "SELECT * FROM predictive_information WHERE selected=1 LIMIT 1");
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

header('Content-Type: application/json');
echo json_encode($data);
