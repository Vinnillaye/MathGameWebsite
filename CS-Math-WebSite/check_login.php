<?php
include_once 'fileIO.php';
echo "<pre>";
//print_r($_POST);

if(isset($_POST['action_name'])){
	switch($_POST['action_name']){
		case 'login':
			$res = check_login();

			if($res === 1){
				//session_status()
				//session_start()
				//$_SESSION[var_name] = $value	
				if(session_status()!==PHP_SESSION_ACTIVE){
					session_start();
				}
				$_SESSION['uname'] = $_POST['username'];
				header("Location: welcome.php");				
				//header("Location: welcome.php?user=".$_POST['username']);
			}else if($res===2){
				print("User does not exist");
			}

			header("refresh: 5; url=login.php");
			break;
	}

}


/**
*Returns 1: can login
*		 2: user does not exist
*		 3: invaild password
*/
function check_login(){
	extract($_POST);

	$info = getUserByName($username);
	//print_r($info);
	//if(isset($info[0])){	
	//	print_r($info[0]);
	//}

	return 1;
}
?>