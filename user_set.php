<?php
session_start();

if(isset($_SESSION['userID']) && isset($_SESSION['userName'])){
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->

		<title>Home </title>
	
		<link rel="stylesheet" type="text/css" href="style_user.css"> 
	</head>
	
	<body>
	

	<?php
		include "header.php";
	?>



		 <h1>Hello, <?php echo $_SESSION['userName']; ?></h1>

		<nav class="user-nav">
			<a href="change-password.php">Change Password</a>
			<a href="change-username.php">Change Username</a> 
			<a href="logout.php">Logout</a>
		</nav>

		<br>
		<br>
		<br>
		<?php
		print_r($_SESSION["uDate"]);
		?>

		<br>
		<br>
		<?php
		print_r($_SESSION["nOfEntries"]);
		?>
		<!-- page wrapper -->
		<div class="page-wrapper">
			
		</div>
		<!-- /page wrapper -->

		<!-- page footer -->
	<?php
		include "footer.php";
	?>
	<!-- /page footer -->

	</body>



</html>

<?php
} else{
	header("Location: index.php");
	exit();
}
?>
