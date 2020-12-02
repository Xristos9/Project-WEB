<?php

	$connect = mysqli_connect("localhost", "root", "", "web");

	$username = $_POST["username"];

	$email = $_POST["email"];

	$password = $_POST["password"];

	function isPasswordAcceptable(string $password) : int{
		if ((strlen($password)<8) or (!preg_match('/\d/', $password)) or (!preg_match('/A-Z/', $password)) or (!preg_match('/\W/', $password))){
				return 0;
		}
		else {
			return 1;
		}
	}

	$validation = isPasswordAcceptable($password);

	$h_password = md5($password);   //hashing

	$cipher = "AES-128-CBC";
	$userID = openssl_encrypt($email, $cipher, $_POST["password"], 0, "1111111111111111");    
	
	$sql_select_maxuserid = "SELECT MAX(userID) FROM `users`";
	$maxusridresult=mysqli_query($connect, $sql_select_maxuserid);

	$row = mysqli_fetch_row($maxusridresult);
	$maxuserid = $row[0];

	$sql_ins_user = "INSERT INTO `users` (`userID`, `username`, `password`, `email`) VALUES ('".($maxuserid+1)."', '".$username."', '".$h_password."', '".$email."')";
	echo $sql_ins_user;
	mysqli_query($connect, $sql_ins_user);

	mysqli_close();

?>