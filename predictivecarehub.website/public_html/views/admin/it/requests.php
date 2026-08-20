<?php

if (isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] == 'patient') {
        header('Location: /patient');
        exit;
    } else if ($_SESSION['user_type'] == 'him') {
        header('Location: /admin/him');
        exit;
    } else if ($_SESSION['user_type'] == 'mrm') {
        header('Location: /admin/mrm');
        exit;
    } else if ($_SESSION['user_type'] == 'doctor') {
        header('Location: /doctor/dashboard');
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
    <title>Admin | Requests</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="../../js/tailwind.js"></script>

    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 font-family-karla flex">

    <?php $activePage = 'requests'; ?>
    <?php $userType = $_SESSION['user_type']; ?>
    <?php include 'partials/sidebar.php' ?>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden relative">

        <?php include 'partials/header.php' ?>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6 mb-24">
                <h1 class="text-3xl text-black pb-6">Requests</h1>

                <div class="w-full mt-6">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Pending Request Lists
                    </p>
                    <div class="container w-full md:w-4/5 xl:w-3/5" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

                        <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white w-full">

                            <table id="request_patients" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th data-priority="2" class="text-left">Patient ID</th>
                                        <th data-priority="3" class="text-left">Patient Name</th>
                                        <th data-priority="4" class="text-left">Request Type</th>
                                        <th data-priority="5" class="text-left">Doctor Name</th>
                                        <th data-priority="6" class="text-left">Doctor ID</th>
                                        <th data-priority="7" class="text-left">Request Date</th>
                                        <th data-priority="1" class="text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT id, patient_id, patient_name, request_type, doctor_name, doctor_id, seen, createdAt FROM medical_records WHERE archived = 0 AND approved = 0";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $doctor_name = $row['doctor_name'] == '' ? "Anonymous" : $row['doctor_name'];
                                            $doctor_id = $row['doctor_id'] == 'others' ? "Not registered" : $row['doctor_id'];
                                            $request_type = $row['request_type'] == '' ? "Blank" : $row['request_type'];
                                            $seen = $row['seen'] == 0 ? '' : 'hidden';

                                            echo "<tr>
                                        <td><span class='text-sm bg-green-300 rounded-full aspect-square p-2 " . e($seen) . "'>New</span> " . e($row['patient_id']) . "</td>
                                        <td>" . e($row['patient_name']) . "</td>
                                        <td>" . e($request_type) . "</td>
                                        <td>" . e($doctor_name) . "</td>
                                        <td>" . e($doctor_id) . "</td>
                                        <td>" . e($row['createdAt']) . "</td>";
                                            echo "<td class='flex items-center flex-wrap sm:flex-nowrap gap-6'>
                                            <button class='group approve_medical' data-id='" . e($row['id']) . "' title='Approve'>
                                                <i class='fas fa-solid fa-check text-green-600 group-hover:text-green-500'></i> Approve
                                            </button>
                                            <button class='group delete_medical' data-delete-type='delete_medical' data-delete-id='" . e($row['id']) . "' title='Delete'>
                                                <i class='fas fa-times text-red-600 group-hover:text-red-500'></i> Delete
                                            </button>
                                        </td>
                                    </tr>";
                                            $updateStmt = mysqli_prepare($conn, "UPDATE medical_records SET seen=1 WHERE id=?");
                                            mysqli_stmt_bind_param($updateStmt, 'i', $row['id']);
                                            mysqli_stmt_execute($updateStmt);
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

    <?php include 'partials/add_user.php'; ?>
    <?php include 'partials/delete_modal.php'; ?>
    <?php include 'partials/upload_modal.php'; ?>
    <?php include 'partials/loading.php'; ?>
    <?php include 'partials/approve_modal.php'; ?>


    <?php include 'partials/scripts.php'; ?>

    <?php $search = 'xenon'; ?>

    <script>
        $(document).ready(function() {

            var table = $('#request_patients').DataTable({
                    order: [
                        [6, 'desc']
                    ],
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>
</body>

</html>