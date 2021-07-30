<html> 
    <link rel="stylesheet" href="navBar.css">
    <head>
    
        <?php 
            include_once "my_functions.php";
            my_session_start();
            include("headerTeacher.php");
        ?>
    </head> 
    <style type="text/css">
        body {background: -webkit-linear-gradient(left, #690534, #271d22);}
        .textFormat {
            text-align: left;   
            font-size: 20px;
            color: white;
            font-family: inherit; /* Important for vertical align on mobile phones */
            }
        .borderexample {
        position:relative;
        border-style:solid;
        border-color:#C0C0C0;
        border-width: 5px;
        max-width: 650px;
        }
    </style>
    <body> 

        <h2 style="color:#C0C0C0;font-family:Lucida Console, Courier New, monospace;">Contact Page</h2>
        <div class="borderexample">
            <p class="textFormat">If any problems arise or bugs are found you can easily contact any of us at: </p>
            <ul class="textFormat">
                <li>MathAdventureDomeAdmin@gmail.com</li>
                <li>1(628) 447-3742 (MathIsEpic)</li>
        </div>
        </ul>
    </body> 