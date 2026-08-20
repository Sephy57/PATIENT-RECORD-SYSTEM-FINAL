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
    <title>Login</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="Login Admin">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="../js/tailwind.js"></script>

    <link rel="stylesheet" href="../css/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 font-family-karla">
    <nav class="relative px-4 py-4 flex justify-between items-center bg-sidebar">
        <a class="ml-0 xl:ml-[5%] text-3xl font-bold leading-none rounded-full h-[50px] p-2 flex justify-center items-center" style="aspect-ratio: 1/1;" href="/">
            <i class="fas fa-solid fa-arrow-left" style="color: #fff;"></i>
        </a>
    </nav>

    <div class="flex justify-center items-center flex-col w-full my-12 pl-0 lg:pl-2 z-[999] header-clip">
        <div class="flex flex-col justify-center items-center mb-6 p-2 bg-sidebar rounded-full">
            <img src="../../assets/logo-transparent.png" alt="" width="100" class="ml-[-5px]">
        </div>
        <p class="text-xl pb-6 flex items-center">
            Login Admin Account
        </p>
        <div class="leading-loose w-[90%] md:w-[80%] lg:w-[50%] xl:w-[25%]">
            <!-- ADMIN LOGIN FORM -->
            <form class="p-10 bg-white rounded-2xl shadow-xl border border-gray-100" id="login_admin">
                <div class="mt-2">
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="username" name="username" type="text" required placeholder="Username" aria-label="Username">
                </div>
                <div class="mt-2">
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="password" name="password" type="password" required placeholder="Password" aria-label="Password">
                    <input type="checkbox" onclick="showPassword('password')"> Show Password
                </div>
                <div class="mt-2">
                    <span class="hidden text-sm text-red-500 el">Email and password don't match.</span>
                </div>
                <div class="mt-2 text-right">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Login</button>
                </div>
            </form>
        </div>
        <p class="mt-6 text-green-500">Healing Lives, Restoring Hope – Your Health, Our Priority</p>
    </div>

    <!-- BOTTOM WAVES -->
    <div style="overflow: hidden;" class="fixed bottom-0 end-0 w-[100%] z-[-1]">
        <svg preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" style="fill: #00c6e4; width: 100%; height: 100px; transform: rotate(180deg) scaleX(-1);">
            <path d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z" opacity=".25" />
            <path d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z" opacity=".5" />
            <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
        </svg>
    </div>

    <?php include 'partials/loading.php'; ?>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="../js/post.js?v=<?php echo time(); ?>"></script>
    <script src="../js/modals.js?v=<?php echo time(); ?>"></script>

</body>

</html>