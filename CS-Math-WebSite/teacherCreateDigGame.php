<?php
include_once("dig_question_generator.php");
include_once("database.php");
include_once("my_functions.php");
my_session_start();
init_database();
$uname = $_SESSION["uname"];

$teacher = get_teacher($uname);

$numLevels = $_POST["numLevels"];
$numDigits = $_POST["numDigits"];
$base = $_POST["base"];
$gameName = $_POST["gameName"];

$newGame = DigPick::createGame($numLevels, $numDigits, $numDigits, $base, $base);
$jsonGame = $newGame->toJson(); 


$teacher->save_level_digit_json($gameName, $jsonGame);

?>
<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<title> Math Adventure Dome</title>
</head> 
<link rel="stylesheet" href="navBar.css">
<style type="text/css">
		body {background: -webkit-linear-gradient(left, #690534, #271d22);}
		body{
			color:#C0C0C0; 
			font-family: Lucida Console, Courier New, monospace;
		}  
  
</style>
    <?php include("headerTeacher.php");?>
<p>Submitted!</p>
<a href="digMenuTeacher.php">Go Back</a>