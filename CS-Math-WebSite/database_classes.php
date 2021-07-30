<?php
//this file contains all the classes for the database


//the user class stores all the data for a user
class user
{

    private $username = "";
    private $password = "";
    private $teacher = "";
    private $digit_score_history = array();
    private $subtract_score_history = array();
    private $add_score_history = array();

    function __construct($username, $password, $teacher, $digit_score_history, $subtract_score_history, $add_score_history)
    {
        //init variables
        $this->username = $username; //username
        $this->password = $password;  //user's password
        $this->teacher = $teacher;  //user's teacher's username
        $this->digit_score_history = $digit_score_history; // user's digit game score history
        $this->subtract_score_history = $subtract_score_history; // user's add subtract game score history
        $this->add_score_history = $add_score_history;
    }

    //get the username
    public function get_username()
    {
        return $this->username;
    }

    //returns the users passwod
    public function get_password()
    {
        return $this->password;
    }
    //get the teacher's username
    public function get_teacher()
    {
        return $this->teacher;
    }

    //returns true if the given password matches
    public function is_valid_password($pass_in)
    {
        return $pass_in == $this->password;
    }

    //returns the user digit game score history - returns and array
    public function get_digit_game_score_history()
    {
        return $this->digit_score_history;
    }

    //returns the highest digit game score
    public function get_digit_game_high_score()
    {
        $history = $this->get_digit_game_score_history();
        if ($history === null || empty($history)) {
            return 0;
        }
        $highest_val = -1;
        foreach ($history as $score) {
            if ($score[2] > $highest_val) {
                $highest_val = $score[2];
            }
        }

        return $highest_val;
    }

    //overwrites the user's digit game score history - takes an array
    public function overwrite_digit_game_score_history($arr_in)
    {
        if (is_array($arr_in)) {
            $this->digit_score_history = $arr_in;
        }
    }

    //returns the users subtract game score history - returns an array
    public function get_subtract_game_score_history()
    {
        return $this->subtract_score_history;
    }

    //overwrites the user's  subtract game score history - takes an array
    public function overwrite_subtract_game_score_history($arr_in)
    {
        if (is_array($arr_in)) {
            $this->subtract_score_history = $arr_in;
        }
    }

    //returns the highest substract game score
    public function get_subtract_game_high_score()
    {
        $history = $this->get_subtract_game_score_history();
        if ($history === null || empty($history)) {
            return 0;
        }
        $highest_val = -1;
        foreach ($history as $score) {
            if ($score[2] > $highest_val) {
                $highest_val = $score[2];
            }
        }

        return $highest_val;
    }

    //returns the users add game score history - returns an array
    public function get_add_game_score_history()
    {
        return $this->add_score_history;
    }

    //overwrites the user's add  game score history - takes an array
    public function overwrite_add_game_score_history($arr_in)
    {
        if (is_array($arr_in)) {
            $this->add_score_history = $arr_in;
        }
    }

    //returns the highest add game score
    public function get_add_game_high_score()
    {
        $history = $this->get_add_game_score_history();
        if ($history === null || empty($history)) {
            return 0;
        }
        $highest_val = -1;
        foreach ($history as $score) {
            if ($score[2] > $highest_val) {
                $highest_val = $score[2];
            }
        }

        return $highest_val;
    }

    //generates and returns the html of user's certificate 
    //takes a php date
    public function generate_certificate($level_name, $score, $problems_solved, $total_problems, $date, $game_type)
    {
        $return_string = '<div style="width: 640px; height: 380px; background-color: maroon; border-radius: 25px; border: 5px solid black;">';
        $return_string = $return_string . '<div style="display: flex; flex-direction: column; justify-content: center; text-align: center;">';
        $return_string = $return_string . '<h1 style="font-family: \'Lucida Sans\'; font-size: 30px; color: white;">' . $this->get_username() . ' - ' . $level_name . '</h1>';
        $return_string = $return_string . '<h1 style="font-family: \'Lucida Sans\'; font-weight: bold; font-size: 25px; color: white;">'.$game_type.'</h1>';
        $return_string = $return_string . '<h1 style=" font-family: \'Lucida Sans\'; font-size: 20px; color: white;">Score: ' . $score . '</h1>';
        $return_string = $return_string . '<h1 style=" font-family: \'Lucida Sans\'; font-size: 20px; color: white;">Solved: ' . $problems_solved . '/' . $total_problems . '</h1>';
        $return_string = $return_string . '<h1 style=" font-family: \'Lucida Sans\'; font-size: 20px; color: white;">' .$date. '</h1>';
        $return_string = $return_string . '<h1 style=" font-family: \'Lucida Sans\'; font-size: 20px; color: grey;">Math Adventure Dome</h1>';
        $return_string = $return_string . '</div></div>';
        return $return_string;
    }

    //creates the certificate folder if it dosen't exist
    private function valid_certificate_folder()
    {
        if (!is_dir("user_certificates/" . $this->username)) {
            mkdir("user_certificates/" . $this->username);
        }
    }
}


//the teacher class stores all the data for a teacher
class teacher
{

    private $username = "";
    private $password = "";
    private $students = [];

    //students is a list of usernames
    function __construct($username, $password, $students)
    {
        //init variables
        $this->username = $username; //username
        $this->password = $password;  //user's password
        $this->students = $students;  //teacher's student's usernames
    }

    //get the username
    public function get_username()
    {
        return  $this->username;
    }

    //get the teacher's students -- returns a list of user names
    public function get_students()
    {
        return  $this->students;
    }

    //returns true if the given password matches
    public function is_valid_password($pass_in)
    {
        return $pass_in ==  $this->password;
    }



    //creates the level folder if it dosen't exist
    private function validate_level_folder()
    {
        if (!is_dir("teacher_levels_digit/" . $this->username)) {
            mkdir("teacher_levels_digit/" . $this->username);
        }
        if (!is_dir("teacher_levels_sub/" . $this->username)) {
            mkdir("teacher_levels_sub/" . $this->username);
        }
        if (!is_dir("teacher_levels_add/" . $this->username)) {
            mkdir("teacher_levels_add/" . $this->username);
        }
        if (!is_dir("teacher_levels_add/included")) {
            mkdir("teacher_levels_add/included");
        }
        if (!is_dir("teacher_levels_sub/included")) {
            mkdir("teacher_levels_sub/included");
        }
    }
    

    //saves a json level to the teacher
    //returns false if the level did not save
    public function save_level_digit_json($level_name, $json_string)
    {
        $this->validate_level_folder();
        if (file_exists("teacher_levels_digit/" . $this->username . "/" . $level_name . ".json")) {
            return false;
        } else {
            $new_level_file = fopen("teacher_levels_digit/" . $this->username . "/" . $level_name . ".json", "w");
            fwrite($new_level_file, $json_string);
            fclose($new_level_file);
        }
    }

    //loads a json level from the teacher
    //returns an empty string if the level could not be loaded
    public function load_level_digit_json($level_name)
    {
        $this->validate_level_folder();
        if (!file_exists("teacher_levels_digit/" . $this->username . "/" . $level_name . ".json")) {
            return "";
        } else {
            $level_file = fopen("teacher_levels_digit/" . $this->username . "/" . $level_name . ".json", "r");
            $to_return = fread($level_file, filesize("teacher_levels_digit/" . $this->username . "/" . $level_name . ".json"));
            fclose($level_file);
            return $to_return;
        }
    }

    //returns an array of all the json levels in the teacher
    public function get_levels_digit_json()
    {
        $this->validate_level_folder();
        $files = scandir("teacher_levels_digit/" . $this->username);
        $json_files = array();
        foreach ($files as &$file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if ($ext = "json") {
                $name = substr($file, 0, -5);
                if ($name != "") {
                    array_push($json_files, $name);
                }
            }
        }

        return $json_files;
    }

    //saves a json level to the teacher
    //returns false if the level did not save
    public function save_level_add_json($level_name, $json_string)
    {
        $this->validate_level_folder();
        if (file_exists("teacher_levels_add/" . $this->username . "/" . $level_name . ".json")) {
            return false;
        } else {
            $new_level_file = fopen("teacher_levels_add/" . $this->username . "/" . $level_name . ".json", "w");
            fwrite($new_level_file, $json_string);
            fclose($new_level_file);
        }
    }

    //loads a json level from the teacher
    //returns an empty string if the level could not be loaded
    public function load_level_add_json($level_name)
    {
        $this->validate_level_folder();
        if(file_exists("teacher_levels_add/" . $this->username . "/" . $level_name . ".json")){
            $level_file = fopen("teacher_levels_add/" . $this->username . "/" . $level_name . ".json", "r");
            $to_return = fread($level_file, filesize("teacher_levels_add/" . $this->username . "/" . $level_name . ".json"));
            fclose($level_file);
            return $to_return;
        }
        else{
            
                $level_file = fopen("teacher_levels_add/included/" . $level_name . ".json", "r");
                $to_return = fread($level_file, filesize("teacher_levels_add/included/" . $level_name . ".json"));
                fclose($level_file);
                return $to_return;
        }
            
        
    }

    //returns an array of all the json levels in the teacher
    public function get_levels_add_json()
    {
        $this->validate_level_folder();
        $files = scandir("teacher_levels_add/" . $this->username);
        $files = array_merge($files, scandir("teacher_levels_add/included/"));
        $json_files = array();
        foreach ($files as &$file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if ($ext = "json") {
                $name = substr($file, 0, -5);
                if ($name != "") {
                    array_push($json_files, $name);
                }
            }
        }

        return $json_files;
    }

    //saves a json level to the teacher
    //returns false if the level did not save
    public function save_level_sub_json($level_name, $json_string)
    {
        $this->validate_level_folder();
        if (file_exists("teacher_levels_sub/" . $this->username . "/" . $level_name . ".json")) {
            return false;
        } else {
            $new_level_file = fopen("teacher_levels_sub/" . $this->username . "/" . $level_name . ".json", "w");
            fwrite($new_level_file, $json_string);
            fclose($new_level_file);
        }
    }

    //loads a json level from the teacher
    //returns an empty string if the level could not be loaded
    public function load_level_sub_json($level_name)
    {
        $this->validate_level_folder();
          if(file_exists("teacher_levels_sub/" . $this->username . "/" . $level_name . ".json")){
                $level_file = fopen("teacher_levels_sub/" . $this->username . "/" . $level_name . ".json", "r");
                $to_return = fread($level_file, filesize("teacher_levels_sub/" . $this->username . "/" . $level_name . ".json"));
                fclose($level_file);
                return $to_return;
	}else{

                $level_file = fopen("teacher_levels_sub/included/" . $level_name . ".json", "r");
                $to_return = fread($level_file, filesize("teacher_levels_sub/included/" . $level_name . ".json"));
                fclose($level_file);
                return $to_return;
          }
        
    }

    //returns an array of all the json levels in the teacher
    public function get_levels_sub_json()
    {
        $this->validate_level_folder();
        $files = scandir("teacher_levels_sub/" . $this->username);
        $files = array_merge($files, scandir("teacher_levels_sub/included"));
        $json_files = array();
        foreach ($files as &$file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if ($ext = "json") {
                $name = substr($file, 0, -5);
                if ($name != "") {
                    array_push($json_files, $name);
                }
            }
        }

        return $json_files;
    }
}
