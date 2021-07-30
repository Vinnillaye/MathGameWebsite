<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>New User</title>
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

    if (isset($_GET['username']) && isset($_GET['password'])) {
        $username = $_GET['username'];
        $password = $_GET['password'];
        if (get_teacher($username) == null) {
            $_SESSION['uname'] = $username;
            add_teacher($username, $password, "");
            header("Location: teacher-login.php");
            $_POST['username'] = "";
            $_POST['password'] = "";
        } else {
            if (get_teacher($username) != null) {
                echo '<script> alert("Teacher already exists") </script>';
            }
        }
    }

    ?>


</head>

<!-- <body>
    <div id="login-box">
        
        <form action="newTeacher.php" method="GET">
            <h1>Create A New Teacher Account</h1>
            <div id="newUsername-box">
                <label for="username">Username:<label>
                        
                        <input type="text" id="username-box" name="username" placeholder="Username" /> 
            </div>
            <br>
            <div id="newPassword-box">
                <label for="password">Password:</label> 
                <input type="password" id="password-box" name="password" placeholder="Password" /> 
            </div>
            <br /><br />
            <div id="createUser-button">
                <button type="submit" id="newTeacher-button" method="POST">Create</button>
            </div>
        </form>
        <a href="teacher-login.php">Back to Login</a> <br>

    </div>
</body> -->
<body>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Math Game</div>
        
      </div>
      <div class="form-container">
        <div class="header">
          
          <label for="login" class="New-login">New Teacher</label>
        </div>
        <div class="form-inner">
          <form action="#" class="login">
            <div class="field">
              <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Password" name="password"required>
            </div>
            <div class="pass-link"><a href="teacher-login.php">Teacher Login</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Create" method="POST">
            </div>
            <div class="signup-link"> <a href="teacher-login.php">Back to Login</a></div>
          </form>
          <form action="#" class="signup">
            <div class="field">
              <input type="text" placeholder="Username" required> 
              <!-- idk why but i tired a slider to have both student and teacher login on same page but it failed due to the php but padding fucks up if i delete it -->
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