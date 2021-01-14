<?php
session_start();

if(isset($_SESSION['userID']) && isset($_SESSION['userName'])){
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Username</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>
    <form action="change-u.php" method="post">
        <h2>Change Username</h2>
        
        <?php if(isset($_GET['error'])) { ?> 
            <p class="error"><?php echo $_GET['error'];?> </p>
        <?php } ?>

        <?php if(isset($_GET['success'])) { ?> 
            <p class="success"><?php echo $_GET['success'];?> </p>
        <?php } ?>
        
        <label>Old Username</label>
        <input type="text" 
               name="ou" 
               placeholder="Old Username">
               <br>
        
        <label>New Username</label>
        <input type="text" 
               name="nu" 
               placeholder="New Username">
               <br>

        <label>Confirm New Username</label>
        <input type="text" 
               name="c_nu" 
               placeholder="Confirm New Username">
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