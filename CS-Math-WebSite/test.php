<?php

require_once("database.php");
require_once("database_classes.php");

$teacher = get_teacher("teacher1");
echo $teacher->load_level_sub_json("level2");
