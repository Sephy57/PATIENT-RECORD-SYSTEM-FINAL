<?php
include 'functions/date_format.php';

if (isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] == 'patient') {
        header('Location: /patient');
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
    <title>Admin | Precaution</title>
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

    <?php $activePage = 'precaution'; ?>
    <?php $userType = $_SESSION['user_type']; ?>
    <?php include 'partials/sidebar.php' ?>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">

        <?php include 'partials/header.php' ?>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6 mb-24">
                <h1 class="text-3xl text-black pb-6">Warning & Precaution</h1>
                <button id="add_precaution_btn" class="w-auto px-5 bg-gray-950 text-white hover:bg-gray-900 text-gray-900 font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl flex items-center justify-center">
                    <i class="fas fa-plus mr-3"></i> Add Precaution
                </button>
                <div class="w-full mt-6">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Precaution Lists
                    </p>
                    <div class="container w-full md:w-4/5 xl:w-3/5" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

                        <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white w-full">

                            <table id="precaution" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th data-priority="2" class="text-left">Title</th>
                                        <th data-priority="3" class="text-left">Description</th>
                                        <th data-priority="4" class="text-left">Last Update</th>
                                        <th data-priority="5" class="text-left">Date Created</th>
                                        <th data-priority="1" class="text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT id, title, description, updatedAt, createdAt FROM precaution_information";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                            <td>" . e($row['title']) .  "</td>
                                        <td>" . e($row['description']) . "</td>
                                        <td>" . e($row['updatedAt']) . "</td>
                                        <td>" . e($row['createdAt']) . "</td>";
                                            echo "<td class='flex items-center flex-wrap sm:flex-nowrap gap-6'>
                                            <button class='group edit_precaution' data-id='" . e($row['id']) . "' data-description='" . e($row['description']) . "' data-title='" . e($row['title']) . "' title='Edit'>
                                                <svg xmlns='http://www.w3.org/2000/svg' class='fill-gray-950 group-hover:fill-gray-600' height='1em' viewBox='0 0 512 512'><path d='M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z'/></svg>
                                            </button>
                                            <button class='group delete_precaution' data-delete-id='" . e($row['id']) . "' data-delete-type='delete_precaution' title='Delete'>
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
    <?php include 'partials/add_precaution.php'; ?>
    <?php include 'partials/edit_precaution.php'; ?>
    <?php include 'partials/scripts.php'; ?>

    <script>
        $(document).ready(function() {

            var table = $('#precaution').DataTable({
                    order: [
                        [4, 'desc']
                    ],
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>
</body>

</html>