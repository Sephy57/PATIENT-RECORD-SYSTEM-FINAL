<?php

if (isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] == 'him') {
        header('Location: /admin/him');
        exit;
    } else if ($_SESSION['user_type'] == 'it') {
        header('Location: /admin/it');
        exit;
    } else if ($_SESSION['user_type'] == 'mrm') {
        header('Location: /admin/mrm');
        exit;
    } else if ($_SESSION['user_type'] == 'doctor') {
        header('Location: /doctor');
        exit;
    }
} else {
    header('Location: /404');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient | Reports</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="Patient Reports">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="../../js/tailwind.js"></script>

    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">

    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 font-family-karla flex">

    <?php $activePage = 'reports'; ?>
    <?php $userType = $_SESSION['user_type']; ?>
    <?php include 'partials/sidebar.php' ?>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden relative">

        <?php include 'partials/header.php' ?>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6 mb-24">
                <h1 class="text-3xl text-black pb-6">Medical Records</h1>
                <div class="w-full mt-6">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Requested Medical Records
                    </p>
                    <div class="container w-full md:w-4/5 xl:w-3/5" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

                        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white w-full">

                            <table id="reports" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th data-priority="2" class="text-left">Request Type</th>
                                        <th data-priority="3" class="text-left">Doctor</th>
                                        <th data-priority="4" class="text-left">Date of Request</th>
                                        <th data-priority="1" class="text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $patient_id_param = $_SESSION['user_id'];
                                    $sql = "SELECT id, request_type, doctor_name, document, prescription, createdAt FROM medical_records WHERE patient_id = ? AND approved = 1 AND archived = 0";
                                    $stmt = mysqli_prepare($conn, $sql);
                                    mysqli_stmt_bind_param($stmt, 's', $patient_id_param);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $document = $row['document'] == null ? "#" : "/download/medical?id=" . $row['id'] . "&filename=" . urlencode($row['request_type']) . "";
                                            $prescription = $row['prescription'] == null ? "#" : "/download/prescription?id=" . $row['id'] . "";
                                            $document_view = $row['document'] == null ? "#" : "/view/document?id=" . $row['id'] . "";
                                            $document_show = $row['document'] == null ? "" : "_blank";
                                            $document_open = $row['document'] == null ? "open_toast" : "";
                                            $document_open1 = $row['prescription'] == null ? "open_toast" : "";
                                            $doctor_name = $row['doctor_name'] == '' ? "Anonymous" : $row['doctor_name'];
                                            $request_type = $row['request_type'] == '' ? "Blank" : $row['request_type'];

                                            echo "<tr>
                                            <td>" . e($request_type) . "</td>
                                            <td>" . e($doctor_name) . "</td>
                                            <td>" . e($row['createdAt']) . "</td>
                                            <td class='flex items-center flex-wrap sm:flex-nowrap gap-6'>
                                            <a class='group " . e($document_open) . "' title='Download PDF' href='" . e($document) . "'>
                                                <i class='fas fa-solid fa-download text-green-600 mr-3'></i>Download PDF
                                            </a>
                                            <a class='group " . e($document_open1) . "' title='Download Prescription' href='" . e($prescription) . "'>
                                                <i class='fas fa-solid fa-download text-orange-600 mr-3'></i>Download Prescription
                                            </a>
                                            <a class='group " . e($document_open) . "' title='View PDF' href='" . e($document_view) . "' target='" . e($document_show) . "'>
                                                <i class='fas fa-solid fa-file-pdf text-blue-600 mr-3'></i>View PDF
                                            </a>
                                        </td>
                                        </tr>";
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="w-full bg-white text-center p-4 bottom-0 absolute">
                &copy; PredictiveCare Hub
            </footer>
        </div>

    </div>

    <?php include 'partials/request.php'; ?>
    <?php include 'partials/toast.php'; ?>
    <?php include 'partials/loading.php'; ?>

    <?php include 'partials/scripts.php'; ?>

    <script>
        $(document).ready(function() {

            var table = $('#reports').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>
</body>

</html>