<?php
include_once("my_functions.php"); 
my_session_start();
session_destroy();

header("Location: login.php");