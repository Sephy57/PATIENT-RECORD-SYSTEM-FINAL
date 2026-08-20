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
    <title>Doctor | Dashboard</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="">
    <link rel="stylesheet" href="../../css/main.css?v=<?php echo time(); ?>">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="../../js/tailwind.js"></script>
</head>

<body class="bg-gray-100 font-family-karla flex">

    <?php $activePage = 'home'; ?>
    <?php $userType = 'doctor'; ?>
    <?php include 'partials/sidebar.php' ?>

    <div class="w-full flex flex-col h-screen overflow-y-hidden relative">

        <?php include 'partials/header.php' ?>

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6 mb-24">
                <h1 class="text-3xl text-black pb-6">Dashboard</h1>

                <?php
                $id = $_SESSION['user_id'];

                $sql = "SELECT doctor_id,username,firstname,lastname  FROM doctors WHERE doctor_id = '$id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    if ($row) {
                ?>

                        <div class="flex flex-wrap mt-24">
                            <div class="w-full lg:w-1/3 pr-0 lg:pr-2 mt-2 lg:mt-0">
                                <div class="p-6 bg-white">
                                    <h1 class="font-semibold">Doctor ID</h1>
                                    <p class="text-slate-500 font-italic uppercase"><?php echo e($row['doctor_id']); ?></p>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/3 pl-0 mt-2 lg:mt-0">
                                <div class="p-6 bg-white">
                                    <h1 class="font-semibold">Name</h1>
                                    <p class="text-slate-500 font-italic"><?php echo e($row['firstname']); ?> <?php echo e($row['lastname']); ?></p>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/3 pl-0 lg:pl-2 mt-2 lg:mt-0">
                                <div class="p-6 bg-white">
                                    <h1 class="font-semibold">Username</h1>
                                    <p class="text-slate-500 font-italic capitalize"><?php echo e($row['username']); ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

                <div class="flex flex-wrap mt-6 w-full">
                    <div class="w-full pr-0 lg:pr-2">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="fas fa-check mr-3"></i> Predictive Analysis
                        </p>
                        <div class="carousel" data-carousel>
                            <?php
                            $monthWords = [
                                1 => 'January',
                                2 => 'February',
                                3 => 'March',
                                4 => 'April',
                                5 => 'May',
                                6 => 'June',
                                7 => 'July',
                                8 => 'August',
                                9 => 'September',
                                10 => 'October',
                                11 => 'November',
                                12 => 'December'
                            ];
                            $sql = "SELECT id, selected, year, month, createdAt FROM predictive_information ORDER BY CAST(year AS SIGNED) DESC, MONTH(month) DESC LIMIT 20";
                            $result = mysqli_query($conn, $sql);
                    
                            if (mysqli_num_rows($result) > 0) {
                    
                            ?>
                                <label class=" block text-md text-gray-50" for="analysis_date">Select Date:</label>
                                <select name="analysis_date" id="analysis_date" class="px-2  mb-5 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" required>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = $row['selected'] == 1 ? 'selected' : '';
                    
                                        echo "<option value=" . e($row['id']) . " " . $selected . ">" . e($monthWords[$row['month']]) . " " . e($row['year']) . "</option>";
                                    }
                    
                                    ?>
                                </select>
                            <?php
                            }
                            ?>
                    
                            <!-- <input class="px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="analysis_date" name="analysis_date" type="date" required aria-label="Birthday"> -->
                            <div class="flex justify-between">
                                <button class="carousel-button prev" data-carousel-button="prev"><i class="fas fa-solid fa-arrow-left ss"></i></button>
                                <button class="carousel-button next" data-carousel-button="next"><i class="fas fa-solid fa-arrow-right ss"></i></button>
                            </div>
                            <div data-slides id="carousel" class="transition-opacity duration-500 ease-in-out slider">
                    
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .ss {
                        color: black !important;
                    }
                </style>



                <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Latest Medical Requests
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-900 text-white">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Patient ID</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Patient Name</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Request Type</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Date of Request</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <?php
                                $doctor_id_param = $_SESSION['user_id'];
                                $sql = "SELECT patient_id, patient_name, request_type, approved, createdAt FROM medical_records WHERE doctor_id = ? AND archived = 0  AND approved = 1 AND request_type = 'Medication List' ORDER BY createdAt DESC";
                                $stmt = mysqli_prepare($conn, $sql);
                                mysqli_stmt_bind_param($stmt, 's', $doctor_id_param);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($result) > 0) {
                                    $num = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($num > 8) {
                                            break;
                                            return;
                                        }

                                        $request_type = $row['request_type'] == '' ? "Blank" : $row['request_type'];

                                        if ($num % 2 == 0) {
                                            echo "<tr >
                                            <td class='text-left py-3 px-4'>" . e($row['patient_id']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['patient_name']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($request_type) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['createdAt']) . "</td>
                                        </tr>";
                                        } else {
                                            echo "<tr class='bg-gray-200'>
                                            <td class='text-left py-3 px-4'>" . e($row['patient_id']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['patient_name']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($request_type) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['createdAt']) . "</td>
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

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="../js/main.js?v=<?php echo time(); ?>"></script>
    <script src="../js/chart.js?v=<?php echo time(); ?>"></script>
</body>

</html>