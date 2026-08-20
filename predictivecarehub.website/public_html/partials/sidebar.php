<?php
// patient sidebar
if ($userType === 'patient') {
?>

    <aside class="relative bg-sidebar h-screen w-64 hidden lg:block shadow-xl">
        <div class="p-6">
            <p class="text-white text-3xl font-semibold uppercase">Patient</p>
            <button class="w-full bg-teal-600 hover:bg-teal-500 text-white font-semibold py-2.5 mt-5 rounded-lg shadow-lg hover:shadow-xl flex items-center justify-center gap-2 transition request_btn">
                <i class="fas fa-plus mr-3"></i> Request
            </button>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="/" class="'opacity-95 transition hover:opacity-100 flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>
            <a href="/patient" class="<?php if ($activePage === 'home') {
                                            echo 'active-nav-link';
                                        } else {
                                            echo 'opacity-95 transition hover:opacity-100';
                                        } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/patient/reports" class="<?php if ($activePage === 'reports') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-file mr-3"></i>
                Requested Medical Records
            </a>
        </nav>
    </aside>

<?php
}
// it staff sidebar
else if ($userType === 'it') {
    $sql = "SELECT * FROM medical_records WHERE archived = 0 AND approved = 0 AND seen = 0";
    $result = mysqli_query($conn, $sql);
    $count = '';
    if (mysqli_num_rows($result) > 0) {
        $count = "(" . mysqli_num_rows($result) . ")";
    }
?>
    <aside class="relative bg-sidebar h-screen w-64 hidden lg:block shadow-xl">
        <div class="p-6">
            <a href="/" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
            <button class="w-full bg-teal-600 hover:bg-teal-500 text-white font-semibold py-2.5 mt-5 rounded-lg shadow-lg hover:shadow-xl flex items-center justify-center gap-2 transition add_user_btn">
                <i class="fas fa-plus mr-3"></i> Add User
            </button>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="/" class="'opacity-95 transition hover:opacity-100 flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>
            <a href="/" class="<?php if ($activePage === 'home') {
                                    echo 'active-nav-link';
                                } else {
                                    echo 'opacity-95 transition hover:opacity-100';
                                } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/admin/approval" class="<?php if ($activePage === 'requests') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-file mr-3"></i>
                Requests <?php echo $count; ?>
            </a>
            <a href="/admin/patients" class="<?php if ($activePage === 'patients') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-user mr-3"></i>
                Patients
            </a>
            <a href="/admin/doctors" class="group <?php if ($activePage === 'doctors') {
                                                        echo 'active-nav-link';
                                                    } else {
                                                        echo 'opacity-95 transition hover:opacity-100';
                                                    } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" class="<?php if ($activePage === 'doctors') {
                                                                                                        echo 'active-nav-link mr-3';
                                                                                                    } else {
                                                                                                        echo 'fill-white mr-3 group-hover:fill-[#111827]';
                                                                                                    } ?>">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16H336c-8.8 0-16-7.2-16-16s7.2-16 16-16V424c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16H256c-8.8 0-16-7.2-16-16V424c0-29.8 20.4-54.9 48-62V304.9c-6-.6-12.1-.9-18.3-.9H178.3c-6.2 0-12.3 .3-18.3 .9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7V311.2zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                </svg>
                Doctors
            </a>
            <a href="/admin/admins" class="<?php if ($activePage === 'admins') {
                                                echo 'active-nav-link';
                                            } else {
                                                echo 'opacity-95 transition hover:opacity-100';
                                            } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-user-secret mr-3"></i>
                Admin
            </a>
            <a href="/admin/services" class="<?php if ($activePage === 'services') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-wrench mr-3"></i>
                Services
            </a>
            <a href="/admin/physicians" class="<?php if ($activePage === 'physicians') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-users mr-3"></i>
                Physicians
            </a>
        </nav>
    </aside>

<?php
}
// medical record manager sidebar
else if ($userType === 'mrm') {

    $sql = "SELECT * FROM medical_records WHERE archived = 0 AND approved = 1 AND seen = 1";
    $result = mysqli_query($conn, $sql);
    $count = '';
    if (mysqli_num_rows($result) > 0) {
        $count = "(" . mysqli_num_rows($result) . ")";
    }
?>

    <aside class="relative bg-sidebar h-screen w-64 hidden lg:block shadow-xl">
        <div class="p-6">
            <a href="/" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="/" class="'opacity-95 transition hover:opacity-100 flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>
            <a href="/admin/mrm" class="<?php if ($activePage === 'home') {
                                            echo 'active-nav-link';
                                        } else {
                                            echo 'opacity-95 transition hover:opacity-100';
                                        } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/admin/requests" class="<?php if ($activePage === 'requests') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-file mr-3"></i>
                Requests <?php echo $count; ?>
            </a>
            <a href="/admin/records" class="<?php if ($activePage === 'records') {
                                                echo 'active-nav-link';
                                            } else {
                                                echo 'opacity-95 transition hover:opacity-100';
                                            } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-file mr-3"></i>
                Medical Records
            </a>
            <a href="/admin/archive" class="<?php if ($activePage === 'archive') {
                                                echo 'active-nav-link';
                                            } else {
                                                echo 'opacity-95 transition hover:opacity-100';
                                            } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-file-archive mr-3"></i>
                Archive
            </a>
        </nav>
    </aside>


<?php
}
// health information manager sidebar
else if ($userType === 'him') {
?>

    <aside class="relative bg-sidebar h-screen w-64 hidden lg:block shadow-xl">
        <div class="p-6">
            <a href="/" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
            <button class="w-full bg-teal-600 hover:bg-teal-500 text-white font-semibold py-2.5 mt-5 rounded-lg shadow-lg hover:shadow-xl flex items-center justify-center gap-2 transition add_predictive_btn">
                <i class="fas fa-plus mr-3"></i> New Data
            </button>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="/" class="'opacity-95 transition hover:opacity-100 flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>
            <a href="/admin/him" class="<?php if ($activePage === 'home') {
                                            echo 'active-nav-link';
                                        } else {
                                            echo 'opacity-95 transition hover:opacity-100';
                                        } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/admin/predictive" class="<?php if ($activePage === 'predictive') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-file mr-3"></i>
                List of Data
            </a>
                        <a href="/admin/precaution" class="<?php if ($activePage === 'precaution') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-exclamation mr-3"></i>
                Precaution
            </a>
        </nav>
    </aside>

<?php
}
// doctor sidebar
else if ($userType === 'doctor') {
?>

    <aside class="relative bg-sidebar h-screen w-64 hidden lg:block shadow-xl">
        <div class="p-6">
            <p class="text-white text-3xl font-semibold uppercase">Doctor</p>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="/" class="'opacity-95 transition hover:opacity-100 flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>
            <a href="/doctor" class="<?php if ($activePage === 'home') {
                                            echo 'active-nav-link';
                                        } else {
                                            echo 'opacity-95 transition hover:opacity-100';
                                        } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/doctor/prescribe" class="<?php if ($activePage === 'prescribe') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center gap-3 py-3 px-4 mx-3 my-0.5 rounded-lg nav-item">
                <i class="fas fa-solid fa-user mr-3"></i>
                Prescribe
            </a>
        </nav>
    </aside>

<?php
}
// if no usertype
else {
    return;
}
?>