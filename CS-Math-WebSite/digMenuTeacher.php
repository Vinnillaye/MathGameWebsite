<?php
//init_database();
//start_session(); 

include_once("database.php");
include_once("my_functions.php");
my_session_start();
init_database();


$uname = $_SESSION["uname"]; 



//$students = get_teacher($uname)->get_students();

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
    <form action="teacherCreateDigGame.php" method="post">
        

        <label for="gameName">Game name:</label><br>
        <input type="text" id="gameName" name="gameName">
    
        <div class="slidecontainer">
            <p>Number of Levels: <span id="numLevels">20</span></p>
            <input type="range" min="1" max="100" value="50" class="slider" id="numLevelsSlide" name="numLevels">
        </div>
        <div class="slidecontainer">
            <p>Number of Digits: <span id="numDigits">3</span></p>
            <input type="range" min="2" max="9" value="3" class="slider" id="numDigitsSlide" name="numDigits">
        </div>
        <div class="slidecontainer">
            <p>Base: <span id="base">10</span></p>
            <input type="range" min="2" max="16" value="10" class="slider" id="baseSlide" name="base">
        </div>
        <script>
        var levSlide = document.getElementById("numLevelsSlide");
        var digSlide = document.getElementById("numDigitsSlide");
        var baseSlide = document.getElementById("baseSlide");

        levSlide.oninput = function() {numLevels.innerHTML = this.value;}
        digSlide.oninput = function() {numDigits.innerHTML = this.value;}
        baseSlide.oninput = function() {base.innerHTML = this.value;}
        </script>


        <br>
        <!--
        <label for="student">Choose a student:</label>
        <select name="student" id="student">
            <option selected="selected">Student:</option>
            <?php
            foreach($students as $student) {
                echo "<option>$student</option>";
            }
            ?>
        </select>
        -->
        <br>
 
        <input type="submit">
    </form>  
    <a href="TeacherView.php">Return to home</a>
</html>








