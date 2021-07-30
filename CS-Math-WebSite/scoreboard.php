<?php
require_once('database.php');
require_once('database_classes.php');
init_database();

function get_current_scoreboard_string(){
    $users = get_scoreboard_users();
    $return_string = '<style> .scoreboard:hover{transform: scale(1.01);} .scoreboard{margin: 100px; border: 5px white solid; border-radius: 30px; display:flex; flex-direction: column; background-color: grey} .user_wrapper{display:flex; flex-direction: row; justify-content: space-between} h5{color: white; font-size: 30px;}</style>';
    $return_string = $return_string. '<div class="scoreboard">';
    foreach($users as $user){
        $return_string = $return_string.make_user_scoreboard_line($user);
    }

    $return_string = $return_string.'</div>';
    return $return_string;
}

function make_user_scoreboard_line($user){
    $average_score = ($user->get_add_game_high_score() + $user->get_subtract_game_high_score() + $user->get_digit_game_high_score()) / 3;
    $return_string = '<div class="user_wrapper">';
    $return_string = $return_string . '<h5 style="margin-left: 100px">'.$user->get_username()."</h5>";
    $return_string = $return_string . '<h5 style="margin-right: 100px">'.$average_score."</h5>";
    $return_string = $return_string."</div>";
    return $return_string;
}

