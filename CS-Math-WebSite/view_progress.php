<!DOCTYPE html>
<html>

<head>

    <?php
    session_start();
    require_once("database.php");
    require_once("database_classes.php");

    init_database();

    if (!isset($_POST["student"])) {
        header("Location: TeacherView.php");
    }
    ?>

    <title><?php echo $_POST["student"] ?> Progress</title>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: -webkit-linear-gradient(left, #690534, #271d22);
            overflow: auto;
        }

        .column_wrapper {
            display: flex;
        }


        h2 {
            color: white;
            margin-left: 40px;
            font-size: 40px;
        }

        h3 {
            color: white;
            font-size: 30px;

        }

        h5 {
            font-size: 20px;
            margin-top: 10px;
            margin-right: 5px;
            color: white;
        }

        .data_holder {
            display: flex;
        }

        .title_wrapper {
            display: flex;
            justify-content: space-between;
        }

        button{
            margin-right: 50px;
            font-size: 40px;
            color: black;
            border-radius: 25px;
            margin-top: 2px;
        }

        button:hover{
            background-color: white;
        }
    </style>




</head>

<body>
    <div class="title_wrapper">
        <h2><?php echo $_POST["student"] ?> Progress</h2>
        <button onclick="window.location.href='TeacherView.php'" >Home</button>
    </div>
    <div class="column_wrapper">


        <ul>
            <h3>Subtraction Game</h3>
            <?php


            $user = get_user($_POST["student"]);
            $history = $user->get_subtract_game_score_history();
            foreach ($history as $val) {
                echo '<div class="data_holder">';
                $val[4] = datetime_string_to_readable($val[4]);
                echo '<h5>' . $val[4] . ' </h5>';
                echo '<h5>' . $val[3] . ': </h5>';
                echo '<h5>' . $val[0] . ' problems correct, out of </h5>';
                echo '<h5>' . $val[1] . ' problems.</h5>';
                echo '<h5>' . $_POST["student"] . ' scored ' . $val[2] . ' points.</h5>';

                echo '</div>';
            }
            ?>
        </ul>

        <ul>
            <h3>Addition Game</h3>
            <?php


            $user = get_user($_POST["student"]);
            $history = $user->get_subtract_game_score_history();
            foreach ($history as $val) {
                echo '<div class="data_holder">';
                $val[4] = datetime_string_to_readable($val[4]);
                echo '<h5>' . $val[4] . ' </h5>';
                echo '<h5>' . $val[3] . ': </h5>';
                echo '<h5>' . $val[0] . ' problems correct, out of </h5>';
                echo '<h5>' . $val[1] . ' problems.</h5>';
                echo '<h5>' . $_POST["student"] . ' scored ' . $val[2] . ' points.</h5>';

                echo '</div>';
            }
            ?>
        </ul>
        <div>




</body>

</html>