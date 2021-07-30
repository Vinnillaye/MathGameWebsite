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

        if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['teacher'])){
            $username = $_GET['username'];
            $password = $_GET['password'];
            $teacher = $_GET['teacher'];
            if(get_user($username) == null && get_teacher($teacher) != null){
                $_SESSION['uname'] = $username;
                add_user($username, $password, $teacher);
                header("Location: login.php");
                $_POST['username'] = "";
                $_POST['password'] = "";
                $_POST['teacher'] = "";
            }else{
                if(get_user($username)!= null){
                    echo '<script> console.log("in") </script>';
                    echo '<script> alert("User already exists") </script>';
                }
                else if(get_teacher($teacher)  == null){
                    echo '<script> alert("Teacher does not exist") </script>';
                }
                
            }
            
            
        }

    ?>
</head>

<!-- <body>
    <div id="login-box">
        
        <form action="newUser.php" method="GET">
            <h1>Create A New Account</h1>
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
            <label for="teacher">Teacher:<label>
                    <input type="text" name="teacher" id="Teacher-class" placeholder="Teacher" />
                    <div id="createUser-button">
                        <button type="submit" id= "newUser-button" method="POST">Create</button>
                    </div>
        </form>
        <a href="login.php">Back to Login</a> <br>


        
    </div>
</body> -->

<body>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Math Game</div>
        
      </div>
      <div class="form-container">
        <div class="header">
          
          <label for="login" class="New-login">New Student</label>
        </div>
        <div class="form-inner">
          <form action="#" class="login">
            <div class="field">
              <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Password" name="password"required>
            </div>
            <div class="field">
              <input type="teacher" placeholder="Teacher" name="teacher" required>
            </div>
            <div class="pass-link"><a href="login.php">Student Login</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Create" method="POST">
            </div>
            <div class="signup-link"> <a href="login.php">Back to Login</a></div>
          </form>
          <form action="#" class="signup">
            <div class="field">
              <input type="text" placeholder="Username" required> 
              <!-- idk why but i tired a slider to have both student and teacher login on same page but it failed due to the php but padding fucks up if i delete it -->
            </div>
            <div class="field">
              <input type="password" placeholder="Password" required>
            </div>
            <div class="field">
              <input type="teacher" placeholder="Teacher" required>
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