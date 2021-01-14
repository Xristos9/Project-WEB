<?php
session_start();

if(isset($_SESSION['userID']) && isset($_SESSION['userName'])){
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->
    
    <title>Home </title>
    <link rel="stylesheet" type="text/css" href="style_home.css"> 
</head>
<body>
    <!-- page header -->
    <?php
        include "header.php";
    ?>
    <!-- /page header -->

    <center><h1>Welcome, <?php echo $_SESSION['userName']; ?></h1></center>
    


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