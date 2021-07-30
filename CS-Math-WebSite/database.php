<?php
require 'database_classes.php';

//define constants
define("DATABASE_LOCATION", "database.sqlite");

//the column names for the user table
define("USER_USERNAME_COLUMN", "username");
define("USER_PASSWORD_COLUMN", "password");
define("USER_TEACHER", "teacher");
define("DIGIT_SCORE_HISTORY", "digit_score_history");
define("SUBTRACT_SCORE_HISTORY", "subtract_score_history");
define("ADD_SCORE_HISTORY", "add_score_history");

//the column names for the teacher table
define("TEACHER_USERNAME_COLUMN", "username");
define("TEACHER_PASSWORD_COLUMN", "password");
define("TEACHER_STUDENTS", "students");

$GLOBALS["database"] = null;

//initializes the database
function init_database()
{

    //if database file dosen't exist. create one
    if (!file_exists(constant("DATABASE_LOCATION"))) {
        $database_file = fopen(constant("DATABASE_LOCATION"), "w");
        fclose($database_file);
    }

    //creates the teacher levels folder if it dosen't exist
    if (!is_dir("teacher_levels_digit")) {
        mkdir("teacher_levels_digit");
    }
    if (!is_dir("teacher_levels_sub")) {
        mkdir("teacher_levels_sub");
    }
    if (!is_dir("teacher_levels_add")) {
        mkdir("teacher_levels_add");
    }

    //initialize the database class
    $database = new SQLite3(constant("DATABASE_LOCATION"));
    $GLOBALS["database"] = $database;

    //setup database file if empty. adds the correct data 
    //add the users table. has username, password and teacher columns
    $database->exec('CREATE TABLE IF NOT EXISTS users (' . constant("USER_USERNAME_COLUMN") . ' 
    varchar(255),' . constant("USER_PASSWORD_COLUMN") . ' varchar(255),' . constant("USER_TEACHER") . ' varchar(255),' . constant("DIGIT_SCORE_HISTORY") . ' varchar(255),' . constant("SUBTRACT_SCORE_HISTORY") . ' varchar(255),' . constant("ADD_SCORE_HISTORY") . ' varchar(255))');

    //add the teachers use table. has username,password and students columns
    $database->exec('CREATE TABLE IF NOT EXISTS teachers (' . constant("TEACHER_USERNAME_COLUMN") . ' 
    varchar(255),' . constant("TEACHER_PASSWORD_COLUMN") . ' varchar(255),' . constant("TEACHER_STUDENTS") . ' varchar(255))');
}

//start the init of the database
init_database();

//adds a user to the database
function add_user($username, $password, $teacher)
{


    $column_arr = array(constant("USER_USERNAME_COLUMN"), constant("USER_PASSWORD_COLUMN"), constant("USER_TEACHER"), constant("DIGIT_SCORE_HISTORY"), constant("SUBTRACT_SCORE_HISTORY"), constant("ADD_SCORE_HISTORY"));
    $data_arr = array($username, $password, $teacher, json_encode(array()), json_encode(array()), json_encode(array()));
    add_to_database('users', $column_arr, $data_arr);
}

//saves an already existing user to the database
//takes a user class
function save_user($user)
{
    if (is_a($user, 'user')) {
        $username = $user->get_username();
        $password = $user->get_password();
        $teacher = $user->get_teacher();
        $digit_history = $user->get_digit_game_score_history();
        $subtract_history = $user->get_subtract_game_score_history();
        $add_history = $user->get_add_game_score_history();
        delete_user($username);
        $column_arr = array(constant("USER_USERNAME_COLUMN"), constant("USER_PASSWORD_COLUMN"), constant("USER_TEACHER"), constant("DIGIT_SCORE_HISTORY"), constant("SUBTRACT_SCORE_HISTORY"),constant("ADD_SCORE_HISTORY"));
        $data_arr = array($username, $password, $teacher, json_encode($digit_history), json_encode($subtract_history),json_encode($add_history));
        add_to_database('users', $column_arr, $data_arr);
    }
}

//deletes a user from the database
function delete_user($username)
{
    $database = $GLOBALS["database"];
    $database->exec('DELETE FROM users WHERE ' . constant("USER_USERNAME_COLUMN") . ' = "' . $username . '";');
}

//adds a teacher to the database
function add_teacher($username, $password, $students)
{
    $column_arr = array(constant("TEACHER_USERNAME_COLUMN"), constant("TEACHER_PASSWORD_COLUMN"), constant("TEACHER_STUDENTS"));
    $data_arr = array($username, $password, $students);
    add_to_database('teachers', $column_arr, $data_arr);
}

//adds the given item into the database
//takes table name, a list of columns and a list of data - must be the same size
//returns true if succeeded or false if failed
function add_to_database($table_name, $columns, $data)
{
    if (count($columns) != count($data)) { //if arrays are not the same length - fail to add
        return false;
    } else { //otherwise try to add the data
        $database = $GLOBALS["database"];
        $column_segment = "(" . implode(",", $columns) . ")";
        $quote_elements_func = function ($e) {
            return "'" . $e . "'";
        };
        $data_segment = "(" . implode(",", array_map($quote_elements_func, $data)) . ")";
        $database->exec('INSERT INTO ' . $table_name . ' ' . $column_segment . ' VALUES' . $data_segment);
        return true;
    }
}




//gets a user from the database
//returns null if the user cannot be found
function get_user($username)
{
    $dataArr = get_from_database("users", constant('USER_USERNAME_COLUMN'), $username);
    if ($dataArr == null) {
        return null;
    }
    return new user($dataArr[0], $dataArr[1], $dataArr[2], json_decode($dataArr[3], true), json_decode($dataArr[4], true), json_decode($dataArr[5], true));
}

//returns all users
function get_all_users()
{
    $database = $GLOBALS["database"];
    $results = $database->query("SELECT * FROM users");

    $user_arr = [];
    while ($row = $results->fetchArray()) {
        if ($row) {


            $counter = 0;
            $current_user = array();
            foreach ($row as &$value) { //values come out as duplicates to we have to filter those out
                if(is_int($counter / 2)){

                    $counter = $counter + 1;
            
                }
                else if ($counter == 11) {
                    array_push($current_user, $value);
                    array_push($user_arr, $current_user);
                    $current_user = array();
                    $counter = 0;
                } else {
                    array_push($current_user, $value);
                    $counter = $counter + 1;
                }
            }
        }
    }

    $users_out = array();
    foreach ($user_arr as $dataArr) {
        if ($dataArr != null) {
            array_push($users_out, new user($dataArr[0], $dataArr[1], $dataArr[2], json_decode($dataArr[3], true), json_decode($dataArr[4], true), json_decode($dataArr[5], true)));
        }
    }


    return $users_out;
}

//gets a user from the database
//returns null if the user cannot be found
function get_teacher($username)
{
    $dataArr = get_from_database("teachers", constant('TEACHER_USERNAME_COLUMN'), $username);
    if ($dataArr == null) {
        return null;
    }
    return new teacher($dataArr[0], $dataArr[1], json_decode($dataArr[2], true));
}


//data from a table where the given column matches the given phrase
function get_from_database($table, $column, $phrase)
{
    try {
        $database = $GLOBALS["database"];
        $results = $database->query("SELECT * FROM " . $table . " WHERE " . $table . "." . $column . "='" . $phrase . "'");

        $dataArr = [];
        if ($row = $results->fetchArray()) {


            $counter = 0;
            foreach ($row as &$value) { //values come out as duplicates to we have to filter those out
                if ($counter == 0) {
                    array_push($dataArr, $value);
                    $counter += 1;
                } else {
                    $counter = 0;
                }
            }


            return $dataArr;
        } else {
            return null;
        }
    } catch (Exception $e) {
        return null;
    }
}

//returns true if the user and password are valid else returns false
function is_login_valid_user($username, $password)
{
    $user = get_user($username);
    if ($user == null) {
        return false;
    } else {
        return $user->is_valid_password($password);
    }
}

//returns true if the user and password are valid else returns false for teacher
function is_login_valid_teacher($username, $password)
{
    $teacher = get_teacher($username);
    if ($teacher == null) {
        return false;
    } else {
        return $teacher->is_valid_password($password);
    }
}

//returns the top 10 users
function  get_scoreboard_users()
{
    $users = get_all_users();
    $sorted = sort_users($users);
    return array_slice($sorted, 0, 10);
  
}

//sorts users by average score
function sort_users($users_in)
{
    $users_in = array_values($users_in);
    $sorted = array();
    while(!empty($users_in)){
        $index = get_index_biggest_score($users_in);
        array_push($sorted, $users_in[$index]);
        array_splice($users_in, $index, 1);
    }

    return $sorted;
}

//returns the index of the user with the biggest average score
function get_index_biggest_score($users)
{
    $highest_score = -1;
    $index = -1;

    $current_pos = 0;
    foreach ($users as $user) {
        $digit = $user->get_digit_game_high_score();
        $subtract = $user->get_subtract_game_high_score();
        $add = $user->get_add_game_high_score();
        $score = ($digit + $subtract + $add) / 3;
        if($score > $highest_score){
            $highest_score = $score;
            $index = $current_pos;
        }

        $current_pos = $current_pos + 1;
    }

    return $index;
}

//returns a string version of a datetime
function datetime_to_string($date)
{
    return $date->format('Y-m-d H:i:s');
}

//converts a date string to an understandable data time string
function datetime_string_to_readable($string){
    $space_pos = strpos($string, " ");
    return substr($string, 0, $space_pos);

}
