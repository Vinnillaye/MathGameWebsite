<?php
include_once("Add_Sub_Game.php");
include_once("database.php");
include_once("my_functions.php");
my_session_start();
init_database();
$uname = $_SESSION["uname"];

$teacher = get_teacher($uname);

$n_questions = $_POST["numQuestions"];
$lvl_difficulty = $_POST["difficultyLevel"];
$g_mode = $_POST["gMode"];
$gameName = $_POST["gameName"];
$newGame = AddSubGame::createGame($lvl_difficulty, $n_questions, $g_mode);
$jsonGame = $newGame->toJson(); 

  
if ($g_mode == "0"){
 	$teacher->save_level_add_json($gameName,$jsonGame);
}
else if ($g_mode == "1"){
	$teacher->save_level_sub_json($gameName,$jsonGame); 
 }



 
	
		

	









?>
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
<a href="addsubTeacherMenu.php">Go Back</a>
