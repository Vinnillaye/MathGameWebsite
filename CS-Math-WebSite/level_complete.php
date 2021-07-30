<!DOCTYPE html>
<html>

<head>
    <title>Level Complete</title>

    <?php
    session_start();
    require_once("database.php");
    require_once("database_classes.php");
    ?>




</head>

<body>

    <?php
    if (isset($_POST["correct_problems"]) && isset($_POST["number_of_problems"]) && isset($_POST["level_name"]) && isset($_POST["date_string"]) && isset($_POST["score_value"]) && isset($_POST["game_type"])) {
        $user = get_user($_SESSION["uname"]);
        if($_POST["game_type"] == "add"){
            $old_history = $user->get_add_game_score_history();
            $new_val = array();
            array_push($new_val, intval($_POST["correct_problems"]));
            array_push($new_val, intval($_POST["number_of_problems"]));
            array_push($new_val, $_POST["level_name"]);
            array_push($new_val, $_POST["date_string"]);
            array_push($new_val, intval($_POST["score_value"]));
            array_push($old_history, $new_val);
            $user->overwrite_add_game_score_history($old_history);
            save_user($user);
	  echo $user->generate_certificate($_POST["level_name"], $_POST["score_value"], $_POST["correct_problems"], $_POST["number_of_problems"], $_POST["date_string"],"Addition Game");

        }
        else if($_POST["game_type"] == "sub"){
            $old_history = $user->get_subtract_game_score_history();
            $new_val = array();
            array_push($new_val, intval($_POST["correct_problems"]));
            array_push($new_val, intval($_POST["number_of_problems"]));
            array_push($new_val, ($_POST["level_name"]));
            array_push($new_val,($_POST["date_string"]));
            array_push($new_val, intval($_POST["score_value"]));
            array_push($old_history, $new_val);
            $user->overwrite_subtract_game_score_history($old_history);
            save_user($user);
		  echo $user->generate_certificate($_POST["level_name"], $_POST["score_value"], $_POST["correct_problems"], $_POST["number_of_problems"], $_POST["date_string"], "Subtraction Game");
        } 
        else if($_POST["game_type"] == "digit"){
            $old_history = $user->get_digit_game_score_history();
            $new_val = array();
            array_push($new_val,intval($_POST["correct_problems"]));
            array_push($new_val,intval( $_POST["number_of_problems"]));
            array_push($new_val, $_POST["level_name"]);
            array_push($new_val, $_POST["date_string"]);
            array_push($new_val, intval($_POST["score_value"]));
            array_push($old_history, $new_val);
            $user->overwrite_digit_game_score_history($old_history);
            save_user($user);
		  echo $user->generate_certificate($_POST["level_name"], $_POST["score_value"], $_POST["correct_problems"], $_POST["number_of_problems"], $_POST["date_string"], "Digit Game");
        }
       
    }



    ?>

    <button onclick="window.location.href='home.php'">Continue</button>

</body>

</html>
