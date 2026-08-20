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
    <title>Patient | Account</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="Patient Account">
    <link rel="stylesheet" href="../../css/main.css?v=<?php echo time(); ?>">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="../../js/tailwind.js"></script>
</head>

<body class="bg-gray-100 font-family-karla flex">
    <?php $activePage = 'account'; ?>
    <?php $userType = $_SESSION['user_type'] ?>
    <?php include 'partials/sidebar.php' ?>

    <div class="w-full flex flex-col h-screen overflow-y-hidden relative">

        <?php include 'partials/header.php' ?>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6 mb-24">
                <h1 class="text-3xl text-black pb-6">Account</h1>
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
                        <div class="w-full mt-6">
                            <form class="p-10 bg-white rounded shadow-xl flex flex-col gap-3" id="update_account">
                                <div>
                                    <p class="text-lg text-gray-800 font-medium pb-2">Personal information</p>
                                    <h1 class="bg-green-300 p-2 rounded hidden" id="profu">Profile Updated</h1>
                                    <div class="inline-block mt-2 w-1/2 pr-1">
                                        <label class="block text-sm text-gray-600" for="firstname">First name</label>
                                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="firstname" value="<?php echo e($row['firstname']) ?>" name="firstname" type="text" required placeholder="First name" aria-label="First name">
                                    </div>
                                    <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                                        <label class="block text-sm text-gray-600" for="lastname">Last name</label>
                                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="lastname" value="<?php echo e($row['lastname']) ?>" name="lastname" type="text" required placeholder="Last name" aria-label="Last name">
                                    </div>
                                    <div class="mt-2">
                                        <label class="block text-sm text-gray-600" for="email">Email</label>
                                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-100 rounded" id="email" value="<?php echo e($row['email']) ?>" name="email" type="email" required placeholder="Email" aria-label="Email" readonly disabled>
                                    </div>
                                    <div class="mt-2">
                                        <label class=" block text-sm text-gray-600" for="birthday">Birthday</label>
                                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="birthday" value="<?php echo e($row['birthday']) ?>" name="birthday" type="date" required aria-label="Birthday">
                                    </div>
                                    <div class="mt-3 flex flex-col sm:flex-row">
                                        <div class="inline-block w-full sm:w-1/2 pr-1">
                                            <label class="block text-sm text-gray-600" for="age">Age</label>
                                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="age" value="<?php echo e($row['age']) ?>" name="age" type="number" required placeholder="Age" aria-label="Age">
                                        </div>

                                        <div class="inline-block pl-1 w-full sm:w-1/2 mt-2 sm:mt-0">
                                            <label class=" block text-sm text-gray-600">Gender</label>
                                            <div class="flex gap-5">
                                                <div>
                                                    <input type="radio" id="male" name="gender" value="male" required <?php if ($row['gender'] == "male") echo "checked"; ?>>
                                                    <label for="male">Male</label><br>
                                                </div>
                                                <div>
                                                    <input type="radio" id="female" name="gender" value="female" required <?php if ($row['gender'] == "female") echo "checked"; ?>>
                                                    <label for="female">Female</label><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="block text-sm text-gray-600" for="address">Address</label>
                                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="address" value="<?php echo e($row['address']) ?>" name="address" type="text" required placeholder="Address" aria-label="Address">
                                    </div>
                                </div>
                                <div>
                                    <p class="text-lg text-gray-800 font-medium pt-4 pb-2">Medical information</p>
                                    <div class="inline-block mt-2 w-1/2 pr-1">
                                        <label class="block text-sm text-gray-600" for="weight">Weight (kg)</label>
                                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="weight" value="<?php echo e($row['weight']) ?>" name="weight" type="number" required placeholder="Weight(kg)" aria-label="Weight">
                                    </div>
                                    <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                                        <label class="block text-sm text-gray-600" for="height">Height (cm)</label>
                                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="height" value="<?php echo e($row['height']) ?>" name="height" type="number" required placeholder="Height(cm)" aria-label="Height">
                                    </div>
                                    <div class="mt-2">
                                        <label class="block text-sm text-gray-600" for="bloodtype">Select Blood Type</label>
                                        <select name="bloodtype" id="bloodtype" class="w-full px-5  py-4 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg">
                                            <option value="a+" <?php if ($row['bloodtype'] == "a+") echo "selected"; ?>>A+</option>
                                            <option value="a-" <?php if ($row['bloodtype'] == "a-") echo "selected"; ?>>A-</option>
                                            <option value="b+" <?php if ($row['bloodtype'] == "b+") echo "selected"; ?>>B+</option>
                                            <option value="b-" <?php if ($row['bloodtype'] == "b-") echo "selected"; ?>>B-</option>
                                            <option value="o+" <?php if ($row['bloodtype'] == "o+") echo "selected"; ?>>O+</option>
                                            <option value="o-" <?php if ($row['bloodtype'] == "o-") echo "selected"; ?>>O-</option>
                                            <option value="ab+" <?php if ($row['bloodtype'] == "ab+") echo "selected"; ?>>AB+</option>
                                            <option value="ab-" <?php if ($row['bloodtype'] == "ab-") echo "selected"; ?>>AB-</option>
                                        </select>
                                    </div>
                                    <div>
                                        <div class="mt-6 text-right">
                                            <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="w-full mt-6">
                            <form class="p-10 bg-white rounded shadow-xl flex flex-col gap-3" id="update_password">
                                <p class="text-lg text-gray-800 font-medium pb-2">Change password</p>
                                <h1 class="bg-green-300 p-2 rounded hidden" id="passu">Password Updated</h1>
                                <div>
                                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="oldpassword" name="oldpassword" type="password" required placeholder="Old Password" aria-label="Old Password">
                                    <span class="hidden text-sm text-red-500 pwddm" id="incorrect">Password incorrect.</span>
                                </div>
                                <div>
                                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="password" name="password" type="password" required placeholder="New Password" aria-label="New Password">
                                </div>
                                <div>
                                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="confirm_pass" name="confirm_pass" type="password" required placeholder="Confirm New password" aria-label="Confirm New Password">
                                    <input type="checkbox" onclick="showPassword('oldpassword'), showPassword('password'), showPassword('confirm_pass')"> Show Password
                                    <span class="hidden text-sm text-red-500 pwddm">Password don't match.</span>
                                </div>
                                <div class="mt-4 text-right">
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded" type="submit">Update Password</button>
                                </div>
                            </form>
                        </div>
                <?php
                    }
                }
                ?>
            </main>

            <footer class="w-full bg-white text-center p-4 bottom-0 absolute">
                &copy; PredictiveCare Hub
            </footer>
        </div>
    </div>
    <?php include 'partials/request.php'; ?>
    <?php include 'partials/loading.php'; ?>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="../js/post.js?v=<?php echo time(); ?>"></script>
    <script src="../js/update.js?v=<?php echo time(); ?>"></script>
    <script src="../js/delete.js?v=<?php echo time(); ?>"></script>
    <script src="../../js/modals.js?v=<?php echo time(); ?>"></script>

</body>

</html>