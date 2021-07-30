<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php

        require 'database.php';
        include_once "my_functions.php";
        my_session_start();
        if (isset($_SESSION['uname']) && isset($_SESSION["isTeacher"])) {
            if ($_SESSION["isTeacher"] == true){
                header("Location: TeacherView.php");
            } else {
                header("Location: home.php");
            }
        }

 


        init_database();

        if(isset($_GET['username']) && isset($_GET['password'])){
            $username = $_GET['username'];
            $password = $_GET['password'];
            if(is_login_valid_teacher($username, $password)){
                $_SESSION['uname'] = $username;
                $_SESSION['isTeacher'] = true;
                header("Location: TeacherView.php");
                $_POST['username'] = "";
                $_POST['password'] = "";
            }
            else{
                echo '<script> alert("Username and password invalid") </script>';
               
            }
            
            
        }
    ?>

</head>
<body>




<!-- <div id="login-box">
    <h1>Teacher Login</h1>

        <form action="teacher-login.php" method="GET">
            <label for="username">Username:</label>
            <input type="text" id="username-box" name="username"><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password-box" name="password"><br><br>
            <button type="submit" id="login-button" method="POST">Submit</button>
        </form>


        <a href="login.php">Student Login</a> <br>
        <a href="newTeacher.php">New Teacher?</a> <br>
    </div>
    </div>

        </body> -->

        <body>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Math Game</div>
        
      </div>
      <div class="form-container">
        <div class="header">
          
          <label for="login" class="P-login">Teacher Login</label>
        </div>
        <div class="form-inner">
          <form action="#" class="login">
            <div class="field">
              <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="pass-link"><a href="login.php">Student Login</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Login" method="POST">
            </div>
            <div class="signup-link"> <a href="newTeacher.php">New Teacher?</a></div>
            
          </form>
          <form action="#" class="signup">
            <div class="field">
              <input type="text" placeholder="Username" required> 
              <!-- idk why but i tired a slider to have both student and teacher login on same page but it failed do to the php but padding fucks up if i delete it -->
            </div>
            <div class="field">
              <input type="password" placeholder="Password" required>
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Login" >
            </div>
          </form>
        </div>
      </div>
    </div>

</html>