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
    <title>Admin | Administrators</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="../../js/tailwind.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0-beta3/css/all.min.css">


    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">

    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 font-family-karla flex">

    <?php $activePage = 'admins'; ?>
    <?php $userType = $_SESSION['user_type']; ?>
    <?php include 'partials/sidebar.php' ?>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden relative">

        <?php include 'partials/header.php' ?>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6 mb-24">
                <h1 class="text-3xl text-black pb-6">Administrators</h1>

                <div class="w-full mt-6">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Admin Lists
                    </p>
                    <div class="container w-full md:w-4/5 xl:w-3/5" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

                        <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white w-full">

                            <table id="doctors" class="stripe hover reload_table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th data-priority="2" class="text-left">Admin ID</th>
                                        <th data-priority="3" class="text-left">Username</th>
                                        <th data-priority="4" class="text-left">First name</th>
                                        <th data-priority="5" class="text-left">Last Name</th>
                                        <th data-priority="1" class="text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT admin_id, username, firstname, lastname, user_type FROM administrators";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                        <td>" . e($row['admin_id']) . "</td>
                                        <td>" . e($row['username']) . "</td>
                                        <td>" . e($row['firstname']) . "</td>
                                        <td>" . e($row['lastname']) . "</td>
                                        <td class='flex items-center flex-wrap sm:flex-nowrap gap-6'>
                                            <button class='group edit_admin' title='Edit' data-id='" . e($row['admin_id']) . "' data-username='" . e($row['username']) . "' data-firstname='" . e($row['firstname']) . "' data-lastname='" . e($row['lastname']) . "' data-usertype='" . e($row['user_type']) . "'>
                                                <svg xmlns='http://www.w3.org/2000/svg' class='fill-gray-950 group-hover:fill-gray-600' height='1em' viewBox='0 0 512 512'><path d='M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z'/></svg>
                                            </button>
                                            <button class='group delete_admin' data-delete-type='delete_admin' data-delete-id=" . e($row['admin_id']) . " title='Delete'>
                                                <i class='fas fa-solid fa-trash text-red-600 group-hover:text-red-500'></i>
                                            </button>
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

    <?php include 'partials/add_user.php'; ?>
    <?php include 'partials/delete_modal.php'; ?>
    <?php include 'partials/loading.php'; ?>
    <?php include 'partials/edit_admin_modal.php'; ?>


    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script src="../../js/post.js?v=<?php echo time(); ?>"></script>
    <script src="../../js/delete.js?v=<?php echo time(); ?>"></script>
    <script src="../../js/modals.js?v=<?php echo time(); ?>"></script>
    <script src="../../js/update.js?v=<?php echo time(); ?>"></script>

    <script>
        $(document).ready(function() {

            var table = $('#doctors').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>
</body>

</html>