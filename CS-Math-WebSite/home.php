<!-- home page -->
<!DOCTYPE html>

	<head>
		<meta charset="UTF-8">
		<title> Math Adventure Dome</title>
	</head> 
    <link rel="stylesheet" href="navBar.css">
	<style type="text/css">
            body {background: -webkit-linear-gradient(left, #690534, #271d22);}
			body{
				font-family: Monaco;
			}  
	  
	</style>
	
<body>

		<?php 
			include_once "my_functions.php";
			include_once "scoreboard.php";
			my_session_start();
			if(isset($_SESSION['uname'])){	
			}else{
				header("Location: login.php");
			}
			include("headerStudent.php");

			echo get_current_scoreboard_string();
		?>
            
</html>
</body>
</html>