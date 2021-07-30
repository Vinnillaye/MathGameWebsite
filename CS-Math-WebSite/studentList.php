<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<title> Math Adventure Dome</title>
</head>
<link rel="stylesheet" href="navBar.css">
<style type="text/css">
	body {
		background: -webkit-linear-gradient(left, #690534, #271d22);
	}

	body {
		font-family: Monaco;
	}
	
</style>

<body>
	<?php

	include_once "my_functions.php";
	my_session_start();
	if (isset($_SESSION['uname'])) {
	} else {
		header("Location: login.php");
	}
	require_once("database.php");
	require_once("database_classes.php");
	init_database();
	?>
	<style>
		h2 {
			color: white;
			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
		}

		h3 {
			color: white;
			font-size: 20px;
			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
		}

		.progress_wrapper {
			color: grey;
			font-size: 20px;
			margin-left: 50px;
			cursor: pointer;
		}

		.progress_wrapper:hover {
			color: dimgray;
		}

		#user_select_wrapper {
			margin-left: 15px;
			overflow: auto;
		}

		.user_wrapper {
			display: flex;
			vertical-align: middle;
		}
	</style>
	<script>
		function post(path, params, method = 'post') {

			// The rest of this code assumes you are not using a library.
			// It can be made less wordy if you use one.
			const form = document.createElement('form');
			form.method = method;
			form.action = path;

			for (const key in params) {
				if (params.hasOwnProperty(key)) {
					const hiddenField = document.createElement('input');
					hiddenField.type = 'hidden';
					hiddenField.name = key;
					hiddenField.value = params[key];

					form.appendChild(hiddenField);
				}
			}

			document.body.appendChild(form);
			form.submit();
		}
	</script>
	<div id="user_select_wrapper">
		<h2>My Students</h2>
		<ul>
			<?php
			$teacher = get_teacher($_SESSION["uname"]);

			$students = $teacher->get_students();
			foreach ($students as $student) {
				$user = get_user($student);
				echo '<div class="user_wrapper"><h3>' . $user->get_username() . '</h3><h3 class="progress_wrapper" onclick="post(window.location.href=\'view_progress.php\',{student:\'' . $student . '\'})">View Progress</h3></div>';
			}

			?>
		</ul>
	</div>

	</html>
</body>

</html>