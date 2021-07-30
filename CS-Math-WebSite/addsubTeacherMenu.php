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


<html>
    <link rel="stylesheet" href="navBar.css">
	<style type="text/css">
            body {background: -webkit-linear-gradient(left, #690534, #271d22);}
			body{
                color:#C0C0C0; 
				font-family: Lucida Console, Courier New, monospace;
			}  
	</style>
    <?php include("headerTeacher.php");?>
    <form action="teacherCreateAddSubGame.php" method="post">
        

        <label for="gameName">Game name:</label><br>
        <input type="text" id="gameName" name="gameName">
    
        <div class="slidecontainer">
            <p>Number of Questions: <span id="numQuestions">20</span></p>
            <input type="range" min="1" max="100" value="20" class="slider" id="numQuestionsSlide" name="numQuestions">
        </div>
        <div class="slidecontainer">
            <p>Difficulty(1 = single digit, 2 = Double Digit, 3 = Mixed): <span id="difficultyLevel">1</span></p>
            <input type="range" min="1" max="3" value="1" class="slider" id="difficultySlide" name="difficultyLevel">
        </div>
        <div class="slidecontainer">
            <p>GameMode(0 = Addition, 1 = Subtraction): <span id="gMode">0</span></p>
            <input type="range" min="0" max="1" value="0" class="slider" id="gModeSlide" name="gMode">
        </div>
        <script>
        var questionSlide = document.getElementById("numQuestionsSlide");
        var diffSlide = document.getElementById("difficultySlide");
        var gModeSlide = document.getElementById("gModeSlide");

        questionSlide.oninput = function() {numQuestions.innerHTML = this.value;}
        diffSlide.oninput = function() {difficultyLevel.innerHTML = this.value;}
        gModeSlide.oninput = function() {gMode.innerHTML = this.value;}
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
