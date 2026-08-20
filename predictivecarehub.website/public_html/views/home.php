<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PredictiveCare Hub</title>
	<link rel="shortcut icon" href="../assets/logo-transparent.png" type="image/x-icon">
	<meta name="description" content="PredictiveCare Hub Homepages">

	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

	<!-- Tailwind -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
	<script src="./js/tailwind.js"></script>

	<link rel="stylesheet" href="../css/main.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 font-family-karla">
	<div class="hidden z-[-1]" id="home"></div>
	<nav class="sticky top-0 px-4 py-4 flex justify-between items-center bg-sidebar z-[998] shadow">
		<a class="ml-0 xl:ml-[5%] text-3xl font-bold leading-none" href="/">
			<img src="../assets/logo-transparent.png" alt="" class="h-[50px] w-[50px] aspect-square rounded-full">
		</a>
		<div class="lg:hidden">
			<button class="navbar-burger flex items-center text-[#EFEFF1] p-3">
				<svg class="block h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
				</svg>
			</button>
		</div>
		<ul class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6 gap-2">
			<li><button class="text-sm text-[#EFEFF1] hover:text-gray-200 font-bold home-btn">Home</button></li>

			<li><button class="text-sm text-[#EFEFF1] hover:text-gray-200 font-bold precprev-btn">Precaution & Prevention</button></li>

			<li><button class="text-sm text-[#EFEFF1] hover:text-gray-200 font-bold about-btn">About</button></li>


			<li><button class="text-sm text-[#EFEFF1] hover:text-gray-200 font-bold services-btn">Services</button></li>

			<li><button class="text-sm text-[#EFEFF1] hover:text-gray-200 font-bold physician-btn">Physician</button></li>


			<li><button class="text-sm text-[#EFEFF1] hover:text-gray-200 font-bold contact-btn">Contact</button></li>
		</ul>
		<?php
		    if (isset($_SESSION['user_type'])) {
		        $dashboard_url = '';
		        if ($_SESSION['user_type'] == 'patient') {
                    $dashboard_url = '/patient';
                } else if ($_SESSION['user_type'] == 'him') {
                    $dashboard_url = '/admin/him';
                } else if ($_SESSION['user_type'] == 'it') {
                    $dashboard_url = '/admin/it';
                } else if ($_SESSION['user_type'] == 'mrm') {
                    $dashboard_url = '/admin/mrm';
                } else if ($_SESSION['user_type'] == 'doctor') {
                    $dashboard_url = '/doctor/dashboard';
                }
                
		        echo "<div class='mr-0 xl:mr-[5%] hidden lg:flex'><a class='hidden lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-border text-sm text-[#EFEFF1] border font-bold  rounded transition duration-200' href='".$dashboard_url ."'><i class='mr-3 fas fa-solid fa-user'></i>Dashboard</a></div>";
		       
		    } else {
		         echo "<div class='mr-0 xl:mr-[5%] hidden lg:flex'><a class='hidden lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-border text-sm text-[#EFEFF1] border font-bold  rounded transition duration-200' href='/register'>Register</a><a class='hidden lg:inline-block py-2 px-6 bg-[#EFEFF1] text-sm text-primary font-bold rounded transition duration-200' href='/login'>Login</a></div>";
		    }
		?>
		
	</nav>
	<div class="navbar-menu relative hidden z-[999]">
		<div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
		<nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-[#EFEFF1] border-r overflow-y-auto">
			<div class="flex items-center mb-8">
				<a class="mr-auto text-3xl font-bold leading-none" href="/">
					<img src="../assets/logo-dark.png" alt="" class="h-[70px] w-[70px] aspect-square rounded-full">
				</a>
				<button class="navbar-close">
					<svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>
			</div>
			<div>
				<ul>
					<li class="mb-1">
						<button class="block p-4 text-sm font-semibold text-gray-950 hover:bg-blue-50 hover:text-blue-600 rounded home-btn">Home</button>
					</li>
					<li class="mb-1">
						<button class="block p-4 text-sm font-semibold text-gray-950 hover:bg-blue-50 hover:text-blue-600 rounded precprev-btn">Precaution & Prevention</button>
					</li>
					<li class="mb-1">
						<button class="block p-4 text-sm font-semibold text-gray-950 hover:bg-blue-50 hover:text-blue-600 rounded about-btn">About</button>
					</li>
					<li class="mb-1">
						<button class="block p-4 text-sm font-semibold text-gray-950 hover:bg-blue-50 hover:text-blue-600 rounded services-btn">Services</button>
					</li>
					<li class="mb-1">
						<button class="block p-4 text-sm font-semibold text-gray-950 hover:bg-blue-50 hover:text-blue-600 rounded physician-btn">Physician</button>
					</li>
					<li class="mb-1">
						<button class="block p-4 text-sm font-semibold text-gray-950 hover:bg-blue-50 hover:text-blue-600 rounded contact-btn">Contact</button>
					</li>
				</ul>
			</div>
			
			<div class="mt-auto">
			<?php
		    if (isset($_SESSION['user_type'])) {
		        $dashboard_url = '';
		        if ($_SESSION['user_type'] == 'patient') {
                    $dashboard_url = '/patient';
                } else if ($_SESSION['user_type'] == 'him') {
                    $dashboard_url = '/admin/him';
                } else if ($_SESSION['user_type'] == 'it') {
                    $dashboard_url = '/admin/it';
                } else if ($_SESSION['user_type'] == 'mrm') {
                    $dashboard_url = '/admin/mrm';
                } else if ($_SESSION['user_type'] == 'doctor') {
                    $dashboard_url = '/doctor/dashboard';
                }
                
		        echo "<div class='pt-6'><a class='block px-4 py-3 mb-2 leading-loose text-xs text-center text-[#EFEFF1] font-semibold bg-sidebar rounded-xl' href='". $dashboard_url ."'>Dashboard</a></div>";
		       
		    } else {
		         echo "<div class='pt-6'><a class='block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold leading-none bg-border rounded-xl' href='/register'>Register</a><a class='block px-4 py-3 mb-2 leading-loose text-xs text-center text-[#EFEFF1] font-semibold bg-sidebar rounded-xl' href='/login'>Login</a></div>";
		    }
		?>
			</div>
		</nav>
	</div>

	<?php include 'partials/home/banner.php'; ?>
	<?php include 'partials/home/preventions.php'; ?>
	<?php include 'partials/home/precaution_prevention.php'; ?>
	<?php include 'partials/home/about.php'; ?>
	<?php include 'partials/home/services.php'; ?>
	<?php include 'partials/home/members.php'; ?>
	<?php include 'partials/home/contact.php'; ?>
	<?php include 'partials/home/footer.php'; ?>

	<!-- CONTACT MODAL -->
	<div class="w-full h-full shadow">
		<div id="contact_modalbg" class="w-screen h-screen bg-[rgba(0,0,0,.6)] top-0 fixed z-[998] hidden"></div>
		<div id="contact_modal" class="z-[999] w-[90%] lg:w-auto flex flex-col items-center gap-2 -translate-y-1/2 py-6 px-12 bg-[#EFEFF1] rounded top-1/2 left-1/2 -translate-x-1/2 fixed hidden">
			<svg xmlns="http://www.w3.org/2000/svg" class="text-[#EFEFF1] mx-auto h-11 rounded-full bg-green-500 w-11 p-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 13l4 4L19 7" />
			</svg>
			<span class="mt-3 text-lg font-bold  text-center">Sent!</span>
			<p class="text-center">Thank you for getting in touch!<br>We appreciate you contacting us PredictiveCare Hub.<br>.One of our colleagues will get back in touch with you soon! Have a great day!</p>
			<button id="contact_button" class="mt-3 p-3 bg-teal-600 hover:bg-teal-500 rounded-full px-12 text-gray-50 text-center shadow">Close</button>
		</div>
	</div>

	<?php include 'partials/loading.php'; ?>
	<?php include 'partials/chatbot_widget.php'; ?>

	<!-- Font Awesome -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
	<!-- jQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- ChartJS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<script src="../js/main.js?v=<?php echo time(); ?>"></script>
	<script src="../js/chart.js?v=<?php echo time(); ?>"></script>
	<script>
		AOS.init();
	</script>
</body>

</html>