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
    <title>Register</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="Register Account">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    	<script src="./js/tailwind.js"></script>

    <link rel="stylesheet" href="../css/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 font-family-karla">
    <nav class="px-4 py-4 flex justify-between items-center bg-sidebar">
        <a class="ml-0 xl:ml-[5%] text-3xl font-bold leading-none rounded-full h-[50px] p-2 flex justify-center items-center" style="aspect-ratio: 1/1;" href="/">
            <i class="fas fa-solid fa-arrow-left" style="color: #fff;"></i>
        </a>
    </nav>

    <div class="flex justify-center items-center flex-col w-full pl-0 lg:pl-2 header-clip">
        <div class="flex flex-col justify-center items-center mb-6 p-2 bg-sidebar rounded-full">
            <img src="../assets/logo-transparent.png" alt="" width="100" class="ml-[-5px]">
        </div>
        <p class="text-xl flex items-center ">
            Register Account
        </p>

        <div class="leading-loose p-6">
            <!-- PATIENT REGISTRATION FORM -->
            <form class="p-10 bg-white rounded shadow-xl flex flex-col lg:flex-row gap-3" id="register_account">
                <div>
                    <p class="text-lg text-gray-800 font-medium pb-2">Personal information</p>
                    <div class="inline-block mt-2 w-1/2 pr-1">
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="firstname" name="firstname" type="text" required placeholder="First name" aria-label="First name">
                    </div>
                    <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="lastname" name="lastname" type="text" required placeholder="Last name" aria-label="Last name">
                    </div>
                    <div class="mt-2">
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="number" name="number" type="number" required placeholder="Mobile number" aria-label="Last name">
                    </div>
                    <div class="mt-2">
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="email" name="email" type="email" required placeholder="Email" aria-label="Email">
                        <span class="hidden text-sm text-red-500 ee">Email already used.</span>
                    </div>
                    <div class="mt-2">
                        <label class=" block text-sm text-gray-600" for="birthday">Birthday</label>
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="birthday" name="birthday" type="date" required aria-label="Birthday">
                    </div>
                    <div class="mt-3 flex flex-col sm:flex-row">
                        <div class="inline-block w-full sm:w-1/2 pr-1">
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="age" name="age" type="number" required placeholder="Age" aria-label="Age">
                        </div>

                        <div class="inline-block pl-1 w-full sm:w-1/2 mt-2 sm:mt-0">
                            <label class=" block text-sm text-gray-600">Gender</label>
                            <div class="flex gap-5">
                                <div>
                                    <input type="radio" id="male" name="gender" value="male" required>
                                    <label for="male">Male</label><br>
                                </div>
                                <div>
                                    <input type="radio" id="female" name="gender" value="female" required>
                                    <label for="female">Female</label><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="address" name="address" type="text" required placeholder="Address" aria-label="Address">
                    </div>
                </div>
                <div>
                    <div class="mt-2">
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="password" name="password" type="password" required placeholder="Password" aria-label="Password">
                        <p class="hidden text-sm text-red-500 not_verified">Password must contain 8 characters or longer,</p>
                        <p class="hidden text-sm text-red-500 not_verified">one special character and one number.</p>
                    </div>
                    <div class="mt-2">
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="confirm_pass" name="confirm_pass" type="password" required placeholder="Confirm password" aria-label="Confirm password">
                        <input type="checkbox" onclick="showPassword('confirm_pass'), showPassword('password')"> Show Password
                        <span class="hidden text-sm text-red-500 pwddm">Password don't match.</span>
                    </div>
                    <p class="text-lg text-gray-800 font-medium pt-4 pb-2">Medical information</p>
                    <div class="inline-block mt-2 w-1/2 pr-1">
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="weight" name="weight" type="number" required placeholder="Weight(kg)" aria-label="Weight">
                    </div>
                    <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" id="height" name="height" type="number" required placeholder="Height(cm)" aria-label="Height">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="bloodtype">Select Blood Type</label>
                        <select name="bloodtype" id="bloodtype" class="w-full px-5  py-4 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" required>
                            <option value="a+">A+</option>
                            <option value="a-">A-</option>
                            <option value="b+">B+</option>
                            <option value="b-">B-</option>
                            <option value="o+">O+</option>
                            <option value="o-">O-</option>
                            <option value="ab+">AB+</option>
                            <option value="a-">AB-</option>
                        </select>
                    </div>
                    <div x-data="{ agreed: false }">
                        <div class="mt-2">
                            <label for="agree" x-on:click="agreed = !agreed">
                                <input type="checkbox" id="agree" x-model="agreed"> <span>I have read and agree to </span><a href="/legal/terms" class="text-blue-500 hover:text-blue-600" target="_blank">Terms and Conditions.</a></span>
                            </label>
                        </div>
                        <div class="mt-6 text-right">
                            <button x-bind:class="agreed ? 'px-4 py-1 text-white font-light tracking-wider bg-teal-600 hover:bg-teal-500 rounded' : 'px-4 py-1 text-white font-light tracking-wider bg-gray-500 rounded disable-button'" type="submit" x-bind:disabled="!agreed">Register</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <p class="text-gray-600">
            Have an account? <a href="/login" class="text-blue-500 hover:text-blue-600">Login</a>
        </p>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear() - 18;
    
            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById('birthday').setAttribute('max', today);
        });
    </script>

    <?php include 'partials/register_modals.php'; ?>
    <?php include 'partials/loading.php'; ?>
    