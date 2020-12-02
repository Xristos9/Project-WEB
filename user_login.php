<?php
	session_start();

	$connect = mysqli_connect("localhost", "root", "root", "location");

	ini_set("memory_limit", "800M");


	$username = $_POST["username"];
	$password = $_POST["password"];


	$sql_login = "SELECT userID, admincheck FROM `user` WHERE username = '".$username."' AND password = '".$password."'";
	$result = mysqli_query($connect, $sql_login);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
/* 			$userID = $row["userID"];
			$admincheck = $row["admincheck"];
			$_SESSION["loggedin"] = true;
			$_SESSION["id"] = $userID;
			if($admincheck == 1){ */
			if($row["admincheck"] == 1){
				header('Location: menu.html');
				exit();
			}
			else{
				header('Location: user_menu.php');
				exit();
			}
		}
	} 
	else {
		echo "Unrecognized username and password";
	}

?>