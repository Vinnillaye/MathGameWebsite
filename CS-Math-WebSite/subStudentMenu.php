<?php
include_once("database.php");
include_once("my_functions.php");
my_session_start();
$uname = $_SESSION["uname"];
$tName = get_user($uname)->get_teacher();
$levels = get_teacher($tName)->get_levels_sub_json();


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
<script> 
var game;
var current_round_index;
var correct;
var round;
var n_questions;
var score;
var correct;
var string;
var date; 
var gName;
var type = "sub";  


function test() {
    var gName = document.getElementById("level").value;
    alert(gName);
}

function update() {
    //round = game.roundArray[current_round_index];
    document.getElementById("score").innerHTML = score;
   // document.getElementById("num").innerHTML = round.string;
    document.getElementById("op1").innerHTML = game.Op1[current_round_index];
    document.getElementById("op2").innerHTML = game.Op2[current_round_index];
    //document.getElementById("base").innerHTML = round.base;
    document.getElementById("answer").value="";

}



function answer() {
    var ans = document.getElementById("answer").value;
    var check = game.Op1[current_round_index] - game.Op2[current_round_index]; 

    if (ans == check) {
        score++;
        document.getElementById("response").innerHTML = "<span style='color:green'>Correct!</span>";
    } else {
        document.getElementById("response").innerHTML = "<span style='color:red'>Wrong!</span>";
    }
    current_round_index++;

    if(current_round_index == n_questions){
        endGame(); 
    }


    update();
}

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


 function endGame(){
    levelName = document.getElementById("gameName").value;
    date = <?php echo "'".datetime_to_string (new DateTime ()). "'"; ?>;  
    console.log(levelName); 
     post("level_complete.php", {correct_problems:score, number_of_problems:n_questions, level_name:gName, date_string:date, score_value:score, game_type:type}); 
   //console.log("test"); 
}

function setup() {
    document.getElementById("gameBox").style.display="block";
    n_questions = game.numQ;
    current_round_index = 0;
    //round = game.roundArray[current_round_index];
    score = 0;
    }

function setGame(xhttp) {
	
    game = JSON.parse(xhttp.responseText);

    setup();
    update();
}

function getGameJson() {
    var xhttp = new XMLHttpRequest();
    var jsonOBJ;
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            setGame(xhttp);      
        }
    };
    gName = document.getElementById("level").value;
    var str = "subGame.php?n=" + gName;
    xhttp.open("GET", str ,true);
    xhttp.send();
}

function chooseGame() {
    game = getGameJson();
    document.getElementById("gameName").innerHTML = document.getElementById("level").value;
    document.getElementById("selectGame").style.display = "none";
}
</script>
 
<html>
<?php include("headerStudent.php");?>

<div id="selectGame">
<label for="level">Pick a level to play:</label>
    <select name="level" id="level">
    <option selected="selected" disabled>Level:</option>
    <?php
    foreach($levels as $level) {
        echo "<option value=$level>$level</option>";
    }
    ?>
    </select>
    <button onclick="chooseGame()">Select</button>
</div>
<div style="display:none" id="gameBox">
    <h2>Level: <span id="gameName"></span> </h1>
    <h2>Score: <span style="color:white;font-weight:italic" id="score">0</span></h2>
    <h3>What is  <span id="op1" style="color:white;font-weight:bold"></span> - <span id="op2" style="color:white;font-weight:bold"></span>? </h3>
    <input type="text" id="answer"></input>
    <button type="button" onclick="answer()">Enter</button>
    <br>
    <h3 id="response"></h3>
</div> 

<div style = "display:none" id="gameOver">


</div>
<br>
<a href="home.php">Go to home</a>

</html>
