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
    <title>Verify Account</title>
    <link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
    <meta name="description" content="Verify Account">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="./js/tailwind.js"></script>

    <link rel="stylesheet" href="../css/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 font-family-karla">
    <div class="w-screen h-screen bg-sidebar flex justify-center items-center">
        <?php

        // check query if exit
        if (!empty($params_data['email']) && !empty($params_data['signature'])) {
            $email = $params_data['email'];
            $signature = $params_data['signature'];

            $sql = "SELECT email, account_verified, signature FROM patients WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 's', $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_array($result);

                // check if account/email exist 
                if ($row) {
                    //check signature if equal from database
                    if (hash_equals($row['signature'], $signature) && $row['signature'] != '-') {
                        // check if not verified
                        if ($row['account_verified'] == 0) {
                            $query = "UPDATE patients SET account_verified=1, signature='-' WHERE email=?";
                            $vStmt = mysqli_prepare($conn, $query);
                            mysqli_stmt_bind_param($vStmt, 's', $email);
                            if (mysqli_stmt_execute($vStmt)) {
        ?>
                                <div class="w-full h-full shadow">
                                    <div id="modal-box2" class="w-[90%] lg:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-green-500 w-11 p-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="mt-3  text-lg font-medium">Great! Your account has been verified.</span>
                                        <a class="mt-3 p-3 bg-teal-600 hover:bg-teal-500 rounded-full px-12 text-gray-50 text-center shadow" href="/login">Back to login</a>
                                    </div>
                                </div>
                            <?php
                                // if cannot query
                            } else {
                            ?>
                                <div class="w-full h-full shadow">
                                    <div id="modal-box2" class="w-[90%] lg:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-orange-500 w-11 p-1 fill-white" viewBox="0 0 64 512">
                                            <path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
                                        </svg>
                                        <span class="mt-3 text-lg font-medium">Something went wrong, please try again.</span>
                                        <a class="mt-3 p-3 bg-teal-600 hover:bg-teal-500 rounded-full px-12 text-gray-50 text-center shadow" href="/login">Back to login</a>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            // if already verified
                            ?>
                            <div class="w-full h-full shadow">
                                <div id="modal-box2" class="w-[90%] lg:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-green-500 w-11 p-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="mt-3 text-lg font-medium  text-center">Your account has already verified.</span>
                                    <a class="mt-3 p-3 bg-teal-600 hover:bg-teal-500 rounded-full px-12 text-gray-50 text-center shadow" href="/login">Back to login</a>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        // if doesnt match
                        ?>
                        <div class="w-full h-full shadow">
                            <div id="modal-box2" class="w-[90%] lg:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-orange-500 w-11 p-1 fill-white" viewBox="0 0 64 512">
                                    <path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
                                </svg>
                                <span class="text-lg font-medium mt-3 text-center">The email and signature don't match.<br> Please resend verification or contact tech support.</span>
                                <a class="mt-3 p-3 bg-teal-600 hover:bg-teal-500 rounded-full px-12 text-gray-50 text-center shadow" href="/reverify">Reverify</a>
                            </div>
                        </div>

                    <?php
                    }
                } else {
                    // if account/email doesnt exist 
                    ?>
                    <div class="w-full h-full shadow">
                        <div id="modal-box2" class="w-[90%] lg:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-white rounded top-1/2 left-1/2 -translate-x-1/2 fixed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white mx-auto h-11 rounded-full bg-orange-500 w-11 p-1 fill-white" viewBox="0 0 64 512">
                                <path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
                            </svg>
                            <span class="mt-3 text-lg font-medium text-center">The account you're trying to verify is not registered.<br>Please register first.</span>
                            <a class="mt-3 p-3 bg-teal-600 hover:bg-teal-500 rounded-full px-12 text-gray-50 text-center shadow" href="/register">Register</a>
                        </div>
                    </div>
        <?php
                }
            }
        } else {
            // redirect to 404 page if not exist
            header('Location: /404');
            exit;
        }
        ?>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>