<?php
session_start();

if(isset($_SESSION['userID']) && isset($_SESSION['userName'])){
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>      
    <form action="change-p.php" method="post">
        <h2>Change Password</h2>
        
        <?php if(isset($_GET['error'])) { ?> 
            <p class="error"><?php echo $_GET['error'];?> </p>
        <?php } ?>

        <?php if(isset($_GET['success'])) { ?> 
            <p class="success"><?php echo $_GET['success'];?> </p>
        <?php } ?>

        <label>Old Password</label>
        <input type="password" 
               name="op" 
               placeholder="Old Password">
               <br>
        
        <label>New Password</label>
        <input type="password" 
               name="np" 
               placeholder="New Password">
               <br>

        <label>Confirm New Password</label>
        <input type="password" 
               name="c_np" 
               placeholder="Confirm New Password">
               <br>

        <button type="submit">CHANGE</button>
        <a href="home.php" class="ca">HOME</a>
    </form>
</body>
</html>



<?php
} else{
    header("Location: index.php");
    exit();
}
?>