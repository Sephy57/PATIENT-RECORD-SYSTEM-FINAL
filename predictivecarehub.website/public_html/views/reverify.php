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
    <title>Verification</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="Reverify Account">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    	<script src="./js/tailwind.js"></script>

    <link rel="stylesheet" href="../css/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 font-family-karla">
    <nav class="relative px-4 py-4 flex justify-between items-center bg-sidebar">
        <a class="ml-0 xl:ml-[5%] text-3xl font-bold leading-none rounded-full h-[50px] p-2 flex justify-center items-center" style="aspect-ratio: 1/1;" href="/login">
            <i class="fas fa-solid fa-arrow-left" style="color: #fff;"></i>
        </a>
    </nav>

    <div class="flex justify-center items-center flex-col w-full my-12 pl-0 lg:pl-2 z-[999] header-clip">
        <div class="flex flex-col justify-center items-center mb-6 p-2 bg-sidebar rounded-full">
            <img src="../assets/logo-transparent.png" alt="" width="100" class="ml-[-5px]">
        </div>
        <p class="text-xl pb-6 flex items-center">
            Account Verification
        </p>
        <div class="leading-loose w-[90%] md:w-[80%] lg:w-[50%] xl:w-[25%]">
            <!-- ACCOUNT REVERIFICATION FORM -->
            <form class="p-10 bg-white rounded-2xl shadow-xl border border-gray-100" id="reverify">
                <p></p>
                <div class="mt-2">
                    <label class=" block text-sm text-gray-600 mb-4 text-center" for="email">Please provide the email address that you used when you register for your account.</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="email" name="email" type="email" required placeholder="Email" aria-label="Email">
                </div>
                <div class="mt-2">
                    <span class="hidden text-sm text-red-500 rev">Email is not registered.</span>
                </div>
                <div class="mt-4 text-center">
                    <span class=" block text-sm text-green-600 mb-2">We will send you a link for account verifition.</span>
                </div>
                <div class="mt-6 text-center">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded w-full" type="submit">Send Verification</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'partials/reverify_modals.php'; ?>
    <?php include 'partials/loading.php'; ?>