<?php

if (isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] == 'patient') {
        header('Location: /patient');
        exit;
    } else if ($_SESSION['user_type'] == 'him') {
        header('Location: /admin/him');
        exit;
    } else if ($_SESSION['user_type'] == 'it') {
        header('Location: /admin/it');
        exit;
    } else if ($_SESSION['user_type'] == 'mrm') {
        header('Location: /admin/mrm');
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
    <title>Doctor | Prescribe</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="">

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

    <?php $activePage = 'prescribe'; ?>
    <?php $userType = $_SESSION['user_type']; ?>
    <?php include 'partials/sidebar.php' ?>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden relative">

        <?php include 'partials/header.php' ?>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6 mb-24">
                <h1 class="text-3xl text-black pb-6">Patients</h1>

                <div class="w-full mt-6">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> List of Medical Records
                    </p>
                    <div class="container w-full lg:w-4/5 xl:w-3/5" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

                        <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white w-full">

                            <table id="prescriptions" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th data-priority="2" class="text-left">Patient ID</th>
                                        <th data-priority="3" class="text-left">Patient Name</th>
                                        <th data-priority="4" class="text-left">Request Type</th>
                                        <th data-priority="5" class="text-left">Doctor Name</th>
                                        <th data-priority="6" class="text-left">Doctor ID</th>
                                        <th data-priority="7" class="text-left">Request Date</th>
                                        <th data-priority="8" class="text-left">Status</th>
                                        <th data-priority="1" class="text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT id, patient_id, patient_name, request_type, doctor_name, doctor_id, document, prescription, createdAt FROM medical_records WHERE archived = 0 AND approved = 1 AND request_type = 'Medication List'";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $prescription_view = $row['prescription'] == null ? "#" : "/view/prescription?id=" . $row['id'] . "";
                                            $prescription_show = $row['prescription'] == null ? "" : "_blank";
                                            $prescription_open = $row['prescription'] == null ? "open_toast" : "";
                                            $document_view = $row['document'] == null ? "#" : "/view/document?id=" . $row['id'] . "";
                                            $document_show = $row['document'] == null ? "" : "_blank";
                                            $document_open = $row['document'] == null ? "open_toast" : "";
                                            $file_name = $row['prescription'] == null ? "" : $row['request_type'];
                                            $style = $row['prescription'] == null ? "hidden" : "block";
                                            $status = $row['prescription'] == null ? "No prescription" : "Prescription uploaded";
                                            $request_type = $row['request_type'] == '' ? "Blank" : $row['request_type'];

                                            echo "<tr>
                                        <td>" . e($row['patient_id']) . "</td>
                                        <td>" . e($row['patient_name']) . "</td>
                                        <td>" . e($request_type) . "</td>
                                        <td>" . e($row['doctor_name']) . "</td>
                                        <td>" . e($row['doctor_id']) . "</td>
                                        <td>" . e($row['createdAt']) . "</td>
                                        <td>" . e($status) . "</td>";
                                            echo "<td class='flex items-center flex-wrap sm:flex-nowrap gap-6'>
                                            <button class='group uupload_prescription' title='Update' data-id='" . e($row['id'])  . "' data-file-name='" . e($file_name)  . " Prescription' data-style='" . e($style)  . "'>
                                                <i class='fas fa-solid fa-upload text-blue-600 mr-3'></i> Update
                                            </button>
                                            <a class='group " . e($prescription_open) . "' title='View Prescription' href='" . e($prescription_view) . "' target='" . e($prescription_show) . "'>
                                                <i class='fas fa-solid fa-file-pdf text-blue-600 mr-3'></i>View Prescription
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

    <?php include 'partials/delete_modal.php'; ?>
    <?php include 'partials/upload_modal.php'; ?>
    <?php include 'partials/toast.php'; ?>
    <?php include 'partials/loading.php'; ?>

    <?php include 'partials/scripts.php'; ?>

    <script>
        $(document).ready(function() {

            var table = $('#prescriptions').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>
</body>

</html>