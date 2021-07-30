<?php
include_once("database.php");
include_once("my_functions.php");
my_session_start();
$usr = $_SESSION["uname"];
$name = $_REQUEST["n"];
$level = get_teacher(get_user($usr)->get_teacher())->load_level_add_json($name);
echo $level;