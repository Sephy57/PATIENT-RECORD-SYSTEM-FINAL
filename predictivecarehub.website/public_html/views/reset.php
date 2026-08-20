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
    } else if ($_SESSION['user_type'] == 'doctor') {
        header('Location: /doctor/dashboard');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="Create New Password">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="../js/tailwind.js"></script>

    <link rel="stylesheet" href="../css/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 font-family-karla">
    <nav class="relative px-4 py-4 flex justify-between items-center bg-sidebar">
        <a class="ml-0 xl:ml-[5%] text-3xl font-bold leading-none rounded-full h-[50px] p-2 flex justify-center items-center" style="aspect-ratio: 1/1;" href="/login">
            <i class="fas fa-solid fa-arrow-left" style="color: #fff;"></i>
        </a>
    </nav>

    <?php
    $id = '';
    $resetEmail = '';
    $resetSignature = '';
    // check if query exists
    if (!empty($params_data['email']) && !empty($params_data['signature'])) {
        $email = $params_data['email'];
        $signature = $params_data['signature'];

        $sql = "SELECT patient_id, email, account_verified, signature FROM patients WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        // check if valid
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);

            // if user exist
            if ($row) {
                // if signature match
                if (hash_equals($row['signature'], $signature) && $row['signature'] != '-') {
                    $id = $row['patient_id'];
                    $resetEmail = $row['email'];
                    $resetSignature = $signature;
                } else {
                    // redirect to login if not
                    header('Location: /login');
                    exit;
                }
            } else {
                // if user doesnt exist
                header('Location: /login');
                exit;
            }
        } else {
            // if not valid
            header('Location: /login');
            exit;
        }
    } else {
        // if query doesnt exists
        header('Location: /login');
        exit;
    }
    ?>

    <div class="flex justify-center items-center flex-col w-full my-12 pl-0 lg:pl-2 z-[999] header-clip">
        <div class="flex flex-col justify-center items-center mb-6 p-2 bg-sidebar rounded-full">
            <img src="../assets/logo-transparent.png" alt="" width="100" class="ml-[-5px]">
        </div>
        <p class="text-xl pb-3 flex items-center">
            Create New Password
        </p>
        <div class="leading-loose w-[90%] md:w-[80%] lg:w-[50%] xl:w-[25%]">
            <!-- NEW PASSWORD FORM -->
            <form class="p-10 bg-white rounded-2xl shadow-xl border border-gray-100" id="change_password">
                <input type="hidden" name="email" id="reset_email" value="<?php echo e($resetEmail); ?>">
                <input type="hidden" name="signature" id="reset_signature" value="<?php echo e($resetSignature); ?>">
                <div class="mt-2">
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="password" name="password" type="password" required placeholder="Create New Password" aria-label="Create New Password">
                </div>
                <div class="mt-2">
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="confirm_pass" name="confirm_pass" type="password" required placeholder="Confirm New Password" aria-label="Confirm New Password">
                    <input type="checkbox" onclick="showPassword('confirm_pass'), showPassword('password')"> Show Password
                    <p class="hidden text-sm text-red-500 not_verified">Password must contain 8 characters or longer,</p>
                    <p class="hidden text-sm text-red-500 not_verified">one special character and one number.</p>
                </div>
                <div>
                    <span class="hidden text-sm text-red-500 pwddm">Password don't match.</span>
                </div>
                <div class="mt-6 text-center">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded w-full" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'partials/forgot_modals.php'; ?>
    <?php include 'partials/loading.php'; ?>