
<header>
<h1 style="color:#C0C0C0;font-family:Monaco">Welcome To Math Adventure Dome</h1>


<div class="navbar">
	<style>
	a{
	color:maroon;
}

*{
font-family: Verdana, Helvetica, sans-serif;;

}
	</style>
    <a href="home.php">Home</a>
    <a href="addStudentMenu.php">Addition Game</a>
    <a href="subStudentMenu.php">Subtraction Game</a>
    <a href="digit_student_menu.php">Digit Game</a>
    <div class="topnav-right">
        <div class="dropdownright">
            <button class="dropbtnright"> <?php echo $_SESSION['uname'];?>
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-contentright">  
                <a href="logout_page.php">Logout</a>
            </div>
        </div>
    </div> 
</div>
</header>
