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
    <title>Patient | Dashboard</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="Patient Dashboard">
    <link rel="stylesheet" href="../../css/main.css?v=<?php echo time(); ?>">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="../../js/tailwind.js"></script>
</head>

<body class="bg-gray-100 font-family-karla flex">
    <?php $activePage = 'home'; ?>
    <?php $userType = $_SESSION['user_type'] ?>
    <?php include 'partials/sidebar.php' ?>

    <div class="w-full flex flex-col h-screen overflow-y-hidden relative">

        <?php include 'partials/header.php' ?>

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6 mb-24">
                <h1 class="text-3xl text-black pb-6">Dashboard
                </h1>

                <?php
                $id = $_SESSION['user_id'];

                $sql = "SELECT * FROM patients WHERE patient_id = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 's', $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    if ($row) {
                ?>


                        <div class="flex flex-wrap mt-6">
                            <div class="w-full lg:w-1/3 pr-0 lg:pr-2 mt-2 lg:mt-0">
                                <div class="p-6 bg-white">
                                    <h1 class="font-semibold">Patient ID</h1>
                                    <p class="text-slate-500 font-italic uppercase"><?php echo e($row['patient_id']); ?></p>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/3 pl-0 mt-2 lg:mt-0">
                                <div class="p-6 bg-white">
                                    <h1 class="font-semibold">Patient Name</h1>
                                    <p class="text-slate-500 font-italic"><?php echo e($row['firstname']) . " " . e($row['lastname']); ?></p>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/3 pl-0 lg:pl-2 mt-2 lg:mt-0">
                                <div class="p-6 bg-white">
                                    <h1 class="font-semibold">Gender</h1>
                                    <p class="text-slate-500 font-italic capitalize"><?php echo e($row['gender']); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap lg:mt-2">
                            <div class="w-full lg:w-1/2 pr-0 lg:pr-1 mt-2 lg:mt-0"">
                        <div class=" p-6 bg-white">
                                <h1 class="font-semibold">Patient Birthday</h1>
                                <p class="text-slate-500 font-italic"><?php echo e($row['birthday']); ?></p>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 pl-0 lg:pl-1 mt-2 lg:mt-0">
                            <div class="p-6 bg-white">
                                <h1 class="font-semibold">Patient Age</h1>
                                <p class="text-slate-500 font-italic"><?php echo e($row['age']); ?></p>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>
        </div>

        <div class="w-full mt-12">
            <p class="text-xl pb-3 flex items-center">
                <i class="fas fa-list mr-3"></i> Latest Medical Requests
            </p>
            <div class="bg-white overflow-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-900 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Request Type</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Doctor Name</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Date of Request</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php
                        $patient_id_param = $_SESSION['user_id'];
                        $sql = "SELECT request_type, doctor_name, approved, createdAt FROM medical_records WHERE patient_id = ? AND archived = 0 ORDER BY createdAt DESC";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 's', $patient_id_param);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if (mysqli_num_rows($result) > 0) {
                            $num = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($num > 8) {
                                    break;
                                    return;
                                }

                                $status = $row['approved'] == 1 ? "Reviewed" : "Pending";
                                $doctor_name = $row['doctor_name'] == '' ? "Anonymous" : $row['doctor_name'];
                                $request_type = $row['request_type'] == '' ? "Blank" : $row['request_type'];

                                if ($num % 2 == 0) {
                                    echo "<tr >
                                            <td class='text-left py-3 px-4'>" . e($request_type) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($doctor_name) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['createdAt']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($status) . "</td>
                                        </tr>";
                                } else {
                                    echo "<tr class='bg-gray-200'>
                                            <td class='text-left py-3 px-4'>" . e($request_type) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($doctor_name) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['createdAt']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($status) . "</td>
                                        </tr>";
                                }
                                $num++;
                            }
                        } else {
                            echo "<tr><td class='text-left py-3 px-4'>No medical request available.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </main>


        <footer class="w-full bg-white text-center p-4 bottom-0 absolute">
            &copy; PredictiveCare Hub
        </footer>
    </div>

    </div>
    <?php include 'partials/request.php'; ?>
    <?php include 'partials/loading.php'; ?>

    <?php include 'partials/scripts.php'; ?>

</body>

</html>