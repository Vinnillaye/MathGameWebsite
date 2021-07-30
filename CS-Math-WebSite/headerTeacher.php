<header>

<h1 style="color:#C0C0C0;font-family:Lucida Console, Courier New, monospace;">Welcome To Math Adventure Dome</h1>
        
        <div class="navbar">
        <a href="TeacherView.php">Home</a>
        <a href="addsubTeacherMenu.php">Addition/Subtraction Game</a>
        <a href="digMenuTeacher.php">Digit Game</a>
        <div class="dropdown">
            <button class="dropbtn">More
            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href=studentList.php>View Students</a>
                <a href=contactUs.php>Contact Us</a>
                
            </div>
        </div>
        <div class="topnav-right">
            <div class="dropdownright">
            <button class="dropbtnright"><?php echo $_SESSION['uname'];?>
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-contentright">
                <a href="logout_page.php">Logout</a>
            </div>
        </div>
        </div>
</header>