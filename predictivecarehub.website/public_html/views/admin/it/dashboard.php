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
    <title>Admin | Dashboard</title>
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

    <?php $activePage = 'home'; ?>
    <?php $userType = $_SESSION['user_type']; ?>
    <?php include 'partials/sidebar.php' ?>

    <div class="w-full flex flex-col h-screen overflow-y-hidden relative">

        <?php include 'partials/header.php' ?>

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6 mb-24">
                <h1 class="text-3xl text-black">Dashboard</h1>

                <?php
                $id = $_SESSION['user_id'];

                $sql = "SELECT admin_id,username,firstname,lastname  FROM administrators WHERE admin_id = '$id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    if ($row) {
                ?>


                        <div class="flex flex-wrap mt-6">
                            <div class="w-full lg:w-1/3 pr-0 lg:pr-2 mt-2 lg:mt-0">
                                <div class="p-6 bg-white">
                                    <h1 class="font-semibold">Admin ID</h1>
                                    <p class="text-slate-500 font-italic uppercase"><?php echo e($row['admin_id']); ?></p>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/3 pl-0 mt-2 lg:mt-0">
                                <div class="p-6 bg-white">
                                    <h1 class="font-semibold">First Name</h1>
                                    <p class="text-slate-500 font-italic"><?php echo e($row['firstname']); ?></p>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/3 pl-0 lg:pl-2 mt-2 lg:mt-0">
                                <div class="p-6 bg-white">
                                    <h1 class="font-semibold">Last Name</h1>
                                    <p class="text-slate-500 font-italic capitalize"><?php echo e($row['lastname']); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap lg:mt-2">
                            <div class="w-full lg:w-1/2 pr-0 lg:pr-1 mt-2 lg:mt-0"">
                            <div class=" p-6 bg-white">
                                <h1 class="font-semibold">Username</h1>
                                <p class="text-slate-500 font-italic"><?php echo e($row['username']); ?></p>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 pl-0 lg:pl-1 mt-2 lg:mt-0">
                            <div class="p-6 bg-white">
                                <h1 class="font-semibold">Admin Type</h1>
                                <p class="text-slate-500 font-italic">IT Staff</p>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>

                <!-- 4 NEW ADDED ADMINISTRATOR -->
                <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> New Administrators
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Admin ID</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Username</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">First name</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Last name</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <?php
                                $sql = "SELECT admin_id, username, firstname, lastname FROM administrators ORDER BY createdAt DESC";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $num = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($num > 4) {
                                            break;
                                            return;
                                        }
                                        if ($num % 2 == 0) {
                                            echo " <tr>
                                            <td class='text-left py-3 px-4'>" . e($row['admin_id']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['username']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['firstname']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['lastname']) . "</td>
                                        </tr>";
                                        } else {
                                            echo " <tr class='bg-gray-200'>
                                            <td class='text-left py-3 px-4'>" . e($row['admin_id']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['username']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['firstname']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['lastname']) . "</td>
                                        </tr>";
                                        }
                                        $num++;
                                    }
                                } else {
                                    echo "<tr class='bg-gray-200'><td class='text-left py-3 px-4 text-gray-950' colspan='5'>No Administrators</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 4 NEW ADDED DOCTORS -->
                <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> New Doctors
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Doctor ID</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Username</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">First name</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Last name</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Department</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <?php
                                $sql = "SELECT doctor_id, username, firstname, lastname, department FROM doctors ORDER BY createdAt DESC";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $num = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($num > 4) {
                                            break;
                                            return;
                                        }
                                        if ($num % 2 == 0) {
                                            echo " <tr>
                                            <td class='text-left py-3 px-4'>" . e($row['doctor_id']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['username']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['firstname']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['lastname']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['department']) . "</td>
                                        </tr>";
                                        } else {
                                            echo " <tr class='bg-gray-200'>
                                            <td class='text-left py-3 px-4'>" . e($row['doctor_id']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['username']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['firstname']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['lastname']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['department']) . "</td>
                                        </tr>";
                                        }
                                        $num++;
                                    }
                                } else {
                                    echo "<tr class='bg-gray-200'><td class='text-left py-3 px-4 text-gray-950' colspan='5'>No Doctors</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 4 NEW ADDED USERS -->
                <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> New Users
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Patient ID</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Mobile no.</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">First name</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Last name</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <?php
                                $sql = "SELECT patient_id, number, email, firstname, lastname FROM patients ORDER BY createdAt DESC";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $num = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($num > 4) {
                                            break;
                                            return;
                                        }
                                        if ($num % 2 == 0) {
                                            echo " <tr>
                                            <td class='text-left py-3 px-4'>" . e($row['patient_id']) . "</td>
                                            <td class='text-left py-3 px-4'>0" . e($row['number']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['email']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['firstname']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['lastname']) . "</td>
                                        </tr>";
                                        } else {
                                            echo " <tr class='bg-gray-200'>
                                            <td class='text-left py-3 px-4'>" . e($row['patient_id']) . "</td>
                                            <td class='text-left py-3 px-4'>0" . e($row['number']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['email']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['firstname']) . "</td>
                                            <td class='text-left py-3 px-4'>" . e($row['lastname']) . "</td>
                                        </tr>";
                                        }
                                        $num++;
                                    }
                                } else {
                                    echo "<tr class='bg-gray-200'><td class='text-left py-3 px-4 text-gray-950' colspan='5'>No Patients</td></tr>";
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

    <?php include 'partials/add_user.php'; ?>
    <?php include 'partials/delete_modal.php'; ?>
    <?php include 'partials/loading.php'; ?>


    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="../../js/post.js?v=<?php echo time(); ?>"></script>
    <script src="../../js/modals.js?v=<?php echo time(); ?>"></script>

</body>

</html>