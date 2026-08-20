<?php
// patient navbar
if ($userType === 'patient') {
?>

    <header class="w-full items-center bg-white py-2 px-6 hidden lg:flex">
        <div class="w-1/2"></div>
        <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
            <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 focus:outline-none bg-gray-400 hover:bg-gray-50 focus:bg-gray-50 group z-[1]">
                <i class="fas fa-solid fa-user w-full h-full aspect-square text-white group-hover:text-gray-500  group-focus:text-gray-500"></i>
            </button>
            <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
            <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                <a href="/patient/account" class="block px-4 py-2 account-link hover:text-white">Account</a>
                <a href="/logout?success=true" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
            </div>
        </div>
    </header>

    <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 lg:hidden">
        <div class="flex items-center justify-between">
            <p class="text-white text-3xl font-semibold uppercase">Patient</p>
            <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                <i x-show="!isOpen" class="fas fa-bars"></i>
                <i x-show="isOpen" class="fas fa-times"></i>
            </button>
        </div>

        <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
            <button class="mb-5 w-full bg-white hover:bg-gray-200 hover:text-gray-950 text-gray-900 font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl flex items-center justify-center request_btn">
                <i class="fas fa-plus mr-3"></i> Request
            </button>
            
             <a href="/" class="opacity-95 transition hover:opacity-100 flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>
            <a href="/patient" class="<?php if ($activePage === 'home') {
                                            echo 'active-nav-link';
                                        } else {
                                            echo 'opacity-95 transition hover:opacity-100';
                                        } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/patient/reports" class="<?php if ($activePage === 'reports') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-file mr-3"></i>
                Requested Medical Records
            </a>
            <a href="/patient/account" class="<?php if ($activePage === 'account') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-user mr-3"></i>
                Account
            </a>
            <a href="/logout?success=true" class="flex items-center opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Sign Out
            </a>
        </nav>
    </header>

<?php
}
// it staff navbar
else if ($userType === 'it') {
?>
    <header class="w-full items-center bg-white py-2 px-6 hidden lg:flex">
        <div class="w-1/2"></div>
        <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
            <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 focus:outline-none bg-gray-400 hover:bg-gray-50 focus:bg-gray-50 group z-[1]">
                <i class="fas fa-solid fa-user w-full h-full aspect-square text-white group-hover:text-gray-500  group-focus:text-gray-500"></i>
            </button>
            <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
            <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                <a href="/logout?success=true" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
            </div>
        </div>
    </header>

    <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 lg:hidden">
        <div class="flex items-center justify-between">
            <p class="text-white text-3xl font-semibold uppercase">Admin</p>
            <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                <i x-show="!isOpen" class="fas fa-bars"></i>
                <i x-show="isOpen" class="fas fa-times"></i>
            </button>
        </div>

        <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">

            <button class="w-full bg-white cta-btn font-semibold py-2 mb-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-50 flex z-[1] items-center justify-center add_user_btn">
                <i class="fas fa-plus mr-3"></i> Add User
            </button>

            <a href="/" class="opacity-95 transition hover:opacity-100 flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>

            <a href="/admin/it" class="<?php if ($activePage === 'home') {
                                            echo 'active-nav-link';
                                        } else {
                                            echo 'opacity-95 transition hover:opacity-100';
                                        } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/admin/approval" class="<?php if ($activePage === 'requests') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-file mr-3"></i>
                Requests
            </a>
            <a href="/admin/patients" class="<?php if ($activePage === 'patients') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-user mr-3"></i>
                Patients
            </a>
            <a href="/admin/doctors" class="<?php if ($activePage === 'doctors') {
                                                echo 'active-nav-link';
                                            } else {
                                                echo 'opacity-95 transition hover:opacity-100';
                                            } ?> flex items-center py-2 pl-4 nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" class="fill-white mr-3">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16H336c-8.8 0-16-7.2-16-16s7.2-16 16-16V424c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16H256c-8.8 0-16-7.2-16-16V424c0-29.8 20.4-54.9 48-62V304.9c-6-.6-12.1-.9-18.3-.9H178.3c-6.2 0-12.3 .3-18.3 .9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7V311.2zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                </svg>
                Doctors
            </a>
            <a href="/admin/admins" class="<?php if ($activePage === 'admins') {
                                                echo 'active-nav-link';
                                            } else {
                                                echo 'opacity-95 transition hover:opacity-100';
                                            } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-user-secret mr-3"></i>
                Admin
            </a>
            <a href="/admin/services" class="<?php if ($activePage === 'services') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-wrench mr-3"></i>
                Services
            </a>
            <a href="/admin/physicians" class="<?php if ($activePage === 'physicians') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-users mr-3"></i>
                Physicians
            </a>
            <a href="/logout?success=true" class="flex items-center opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Sign Out
            </a>
        </nav>
    </header>

<?php
}
// medical record manager sidebar
else if ($userType === 'mrm') {
?>

    <header class="w-full items-center bg-white py-2 px-6 hidden lg:flex">
        <div class="w-1/2"></div>
        <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
            <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 focus:outline-none bg-gray-400 hover:bg-gray-50 focus:bg-gray-50 group z-[1]">
                <i class="fas fa-solid fa-user w-full h-full aspect-square text-white group-hover:text-gray-500  group-focus:text-gray-500"></i>
            </button>
            <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
            <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                <a href="/logout?success=true" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
            </div>
        </div>
    </header>

    <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 lg:hidden">
        <div class="flex items-center justify-between">
            <p class="text-white text-3xl font-semibold uppercase">Admin</p>
            <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                <i x-show="!isOpen" class="fas fa-bars"></i>
                <i x-show="isOpen" class="fas fa-times"></i>
            </button>
        </div>

        <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
             <a href="/" class="opacity-95 transition hover:opacity-100 flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>
            <a href="/admin/mrm" class="<?php if ($activePage === 'home') {
                                            echo 'active-nav-link';
                                        } else {
                                            echo 'opacity-95 transition hover:opacity-100';
                                        } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/admin/requests" class="<?php if ($activePage === 'requests') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-file mr-3"></i>
                Requests
            </a>
            <a href="/admin/records" class="<?php if ($activePage === 'records') {
                                                echo 'active-nav-link';
                                            } else {
                                                echo 'opacity-95 transition hover:opacity-100';
                                            } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-file mr-3"></i>
                Medical Records
            </a>
            <a href="/admin/archive" class="<?php if ($activePage === 'archive') {
                                                echo 'active-nav-link';
                                            } else {
                                                echo 'opacity-95 transition hover:opacity-100';
                                            } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-file-archive mr-3"></i>
                Archive
            </a>
            <a href="/logout?success=true" class="flex items-center opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Sign Out
            </a>
        </nav>
    </header>

<?php
}
// health information manager sidebar
else if ($userType === 'him') {
?>

    <header class="w-full items-center bg-white py-2 px-6 hidden lg:flex">
        <div class="w-1/2"></div>
        <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
            <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 focus:outline-none bg-gray-400 hover:bg-gray-50 focus:bg-gray-50 group z-[1]">
                <i class="fas fa-solid fa-user w-full h-full aspect-square text-white group-hover:text-gray-500  group-focus:text-gray-500"></i>
            </button>
            <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
            <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                <a href="/logout?success=true" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
            </div>
        </div>
    </header>

    <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 lg:hidden">
        <div class="flex items-center justify-between">
            <p class="text-white text-3xl font-semibold uppercase">Admin</p>
            <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                <i x-show="!isOpen" class="fas fa-bars"></i>
                <i x-show="isOpen" class="fas fa-times"></i>
            </button>
        </div>

        <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">

            <button class="w-full bg-white cta-btn font-semibold py-2 mb-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-50 flex z-[1] items-center justify-center add_predictive_btn">
                <i class="fas fa-plus mr-3"></i> New Data
            </button>
            
             <a href="/" class="opacity-95 transition hover:opacity-100 flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>

            <a href="/admin/him" class="<?php if ($activePage === 'home') {
                                            echo 'active-nav-link';
                                        } else {
                                            echo 'opacity-95 transition hover:opacity-100';
                                        } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/admin/predictive" class="<?php if ($activePage === 'predictive') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-file mr-3"></i>
                Predictive Analysis
            </a>
            <a href="/admin/precaution" class="<?php if ($activePage === 'precaution') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-95 transition hover:opacity-100';
                                                } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-exclamation mr-3"></i>
                Precaution
            </a>
            <a href="/logout?success=true" class="flex items-center opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Sign Out
            </a>
        </nav>
    </header>

<?php
}
// doctor navbar
else if ($userType === 'doctor') {
?>
    <header class="w-full items-center bg-white py-2 px-6 hidden lg:flex">
        <div class="w-1/2"></div>
        <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
            <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 focus:outline-none bg-gray-400 hover:bg-gray-50 focus:bg-gray-50 group z-[1]">
                <i class="fas fa-solid fa-user w-full h-full aspect-square text-white group-hover:text-gray-500  group-focus:text-gray-500"></i>
            </button>
            <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
            <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                <a href="/logout?success=true" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
            </div>
        </div>
    </header>

    <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 lg:hidden">
        <div class="flex items-center justify-between">
            <p class="text-white text-3xl font-semibold uppercase">Doctor</p>
            <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                <i x-show="!isOpen" class="fas fa-bars"></i>
                <i x-show="isOpen" class="fas fa-times"></i>
            </button>
        </div>

        <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
             <a href="/" class="opacity-95 transition hover:opacity-100 flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-home mr-3"></i>
                Home
            </a>
            <a href="/doctor" class="<?php if ($activePage === 'home') {
                                            echo 'active-nav-link';
                                        } else {
                                            echo 'opacity-75 hover:opacity-100';
                                        } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="/doctor/prescribe" class="<?php if ($activePage === 'prescribe') {
                                                    echo 'active-nav-link';
                                                } else {
                                                    echo 'opacity-75 hover:opacity-100';
                                                } ?> flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-solid fa-user mr-3"></i>
                Prescribe
            </a>
            <a href="/logout?success=true" class="flex items-center opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Sign Out
            </a>
        </nav>
    </header>

<?php
}
// if no usertype
else {
    return;
}
?>
<?php include __DIR__ . '/chatbot_widget.php'; ?>