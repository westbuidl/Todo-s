<?php

require_once('includes/dbconn.php');
?>
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
		.modal {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.5);
			z-index: 1000;
		}

		.modal-content {
			background-color: white;
			margin: 15% auto;
			padding: 20px;
			width: 90%;
			max-width: 500px;
			border-radius: 4px;
		}

		@media (max-width: 768px) {
			table {
				min-width: 100%;
			}

			th,
			td {
				padding: 8px;
			}
		}

		.task-name {
			cursor: pointer;
			color: #0066cc;
			text-decoration: underline;
		}

		.task-name:hover {
			color: #003366;
		}
	</style>
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
				<div class="row" style="width: 100%; margin: 0 auto; padding: 20px 0;">
					<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
						<span style="font-size: 1.5rem; font-weight: bold;">Tasks Overview</span>
						<a href="#" id="add-task-btn" style="background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: 500;">Add task</a>
					</div>

					<div style="overflow-x: auto; width: 100%;">
						<table id="task-table" style="width: 100%; border-collapse: collapse; min-width: 600px;">
							<thead>
								<tr style="background-color: #f9f9f9; border-bottom: 2px solid #ddd;">
									<th style="padding: 12px 15px; text-align: left; font-weight: bold; color: #333;">S/n</th>
									<th style="padding: 12px 15px; text-align: left; font-weight: bold; color: #333;">Ref</th>
									<th style="padding: 12px 15px; text-align: left; font-weight: bold; color: #333;">Task name</th>
									<th style="padding: 12px 15px; text-align: left; font-weight: bold; color: #333;">Date added</th>
									<th style="padding: 12px 15px; text-align: left; font-weight: bold; color: #333;">Status</th>
									<th style="padding: 12px 15px; text-align: left; font-weight: bold; color: #333;">Action</th>
								</tr>
							</thead>
							<tbody>
								<!-- Tasks loaded via AJAX -->
							</tbody>
						</table>
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
	<div id="task-modal" class="modal">
		<div class="modal-content">
			<h2>Add New Task</h2>
			<form id="task-form">
				<div style="margin-bottom: 15px;">
					<label style="display: block; margin-bottom: 5px;">Task Name:</label>
					<input type="text" name="task_name" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
				</div>
				<div style="margin-bottom: 15px;">
					<label style="display: block; margin-bottom: 5px;">Description:</label>
					<textarea name="description" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-height: 100px;"></textarea>
				</div>
				<div style="display: flex; gap: 10px;">
					<button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Save Task</button>
					<button type="button" id="close-modal" style="background-color: #ccc; color: #333; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Cancel</button>
				</div>
			</form>
		</div>
	</div>

	<!-- Task Details Modal -->
	<div id="details-modal" class="modal">
		<div class="modal-content">
			<h2>Task Details</h2>
			<div id="task-details-content"></div>
			<button id="close-details" style="background-color: #ccc; color: #333; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 15px;">Close</button>
		</div>
	</div>
	<!-- Scripts -->
	<script>
		$(document).ready(function() {
			loadTasks();

			// Open add task modal
			$('#add-task-btn').click(function(e) {
				e.preventDefault();
				$('#task-modal').show();
			});

			// Close add task modal
			$('#close-modal').click(function() {
				$('#task-modal').hide();
				$('#task-form')[0].reset();
			});

			// Add task
			$('#task-form').submit(function(e) {
				e.preventDefault();
				$.ajax({
					url: 'task_handler.php',
					type: 'POST',
					data: {
						action: 'add',
						task_name: $('input[name="task_name"]').val(),
						description: $('textarea[name="description"]').val(),
						ref: Math.floor(Math.random() * 1000000000)
					},
					success: function() {
						$('#task-modal').hide();
						$('#task-form')[0].reset();
						loadTasks();
					},
					error: function(xhr) {
						alert('Error adding task: ' + xhr.responseText);
					}
				});
			});

			// Mark as done
			$(document).on('click', '.mark-done', function(e) {
				e.preventDefault();
				let ref = $(this).data('ref');
				$.ajax({
					url: 'task_handler.php',
					type: 'POST',
					data: {
						action: 'mark_done',
						ref: ref
					},
					success: function() {
						loadTasks();
					}
				});
			});

			// Remove task with confirmation
			$(document).on('click', '.remove-task', function(e) {
				e.preventDefault();
				let ref = $(this).data('ref');
				if (confirm('Are you sure you want to remove this task?')) {
					$.ajax({
						url: 'task_handler.php',
						type: 'POST',
						data: {
							action: 'remove',
							ref: ref
						},
						success: function() {
							loadTasks();
						}
					});
				}
			});

			// Show task details
			$(document).on('click', '.task-name', function() {
				let ref = $(this).data('ref');
				$.ajax({
					url: 'task_handler.php',
					type: 'POST',
					data: {
						action: 'get_details',
						ref: ref
					},
					success: function(response) {
						$('#task-details-content').html(response);
						$('#details-modal').show();
					}
				});
			});

			// Close details modal
			$('#close-details').click(function() {
				$('#details-modal').hide();
			});

			// Load tasks
			function loadTasks() {
				$.ajax({
					url: 'task_handler.php',
					type: 'POST',
					data: {
						action: 'load'
					},
					success: function(response) {
						$('#task-table tbody').html(response);
					}
				});
			}
		});
	</script>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.dropotron.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>