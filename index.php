<!DOCTYPE HTML>
<!--
	Todo's 
-->
<html>

<head>
	<title>Todo's | A simple, responsive task management web application built with PHP 8+, MySQL 8+, jQuery, and AJAX</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
</head>

<body class="is-preload homepage">
	<div id="page-wrapper">

		<!-- Header -->
		<div id="header-wrapper">
			<header id="header" class="container">

				<!-- Logo -->
				<div id="logo">
					<h1><a href="index.php">Todo's</a></h1>

				</div>

				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li class="current"><a href="index.php">Welcome</a></li>

						<li><a href="todo.php">Todo's</a></li>

						<li><a href="index.php#about">About</a></li>

					</ul>
				</nav>

			</header>
		</div>

		<!-- Banner -->
		<div id="banner-wrapper">
			<div id="banner" class="box container">
				<div class="row">
					<div class="col-6 col-12-medium">
						<h2>Your pal</h2>
						<p>manage tasks on the fly with Todo's</p>
					</div>
					<div class="col-5 col-12-medium">

						<ul>
							<li><a href="todo.php" class="button large icon fa-arrow-circle-right">Goto Todo's</a></li>

						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Features -->
		<div id="features-wrapper">

		</div>

		<!-- Main -->
		<div id="main-wrapper">
			<div class="container">
				<div class="row gtr-200">
					<div class="col-4 col-12-medium">

						<!-- Sidebar -->
						<div id="sidebar">
							<section class="widget thumbnails">

								<div class="grid">
									<div class="row gtr-50">
										<div class="col-10"><a href="#" class="image fit"><img src="images/task.png" alt="task image" /></a></div>

									</div>
								</div>

							</section>
						</div>

					</div>
					<div class="col-8 col-12-medium imp-medium">

						<!-- Content -->
						<div id="content">
							<section class="last" id="about">
								<h2>Todo's Features</h2>
								<p>
								<ul>
									<li>Responsive design (works on desktop and mobile)</li>
									<li>Task creation with name and description</li>
									<li>Real-time updates via AJAX</li>
									<li>Delete confirmation dialog</li>
									<li>Task details modal</li>
									<li>Status tracking (waiting/done)</li>
								</ul>
								<a href="#" class="button icon fa-arrow-circle-right">Contact Us</a>
							</section>
						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<div id="footer-wrapper">
			<footer id="footer" class="container">

				<div class="row">
					<div class="col-12">
						<div id="copyright">
							<ul class="menu">
								<li>&copy; Todo's 2025. All rights reserved</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>

	</div>

	<!-- Scripts -->

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.dropotron.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>