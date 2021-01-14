<?php
session_start();

if(isset($_SESSION['userID']) && isset($_SESSION['userName'])){

    include "db_conn.php";

if (isset($_POST['op']) && isset($_POST['np']) 
    && isset($_POST['c_np'])){
   
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $op = validate($_POST['op']);
    $np = validate($_POST['np']);
    $c_np = validate($_POST['c_np']);

    if(empty($op)){
        header("Location: change-password.php?error=Old password is required");
        exit();
    } else if(empty($np)){
        header("Location: change-password.php?error=New password is required");
        exit();
    } else if($np !== $c_np){
        header("Location: change-password.php?error=The current password does not match");
        exit();
    } else {
        //hashing password
        //$op = md5($op);
        //$np = md5($np);
        $id = $_SESSION['userID'];

        $sql = "SELECT password
                FROM person WHERE
                userID='$id' AND password='$op'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            
            $sql2 = "UPDATE person 
                     SET password='$np'
                     WHERE userID='$id'";
            $result_2 = mysqli_query($conn, $sql2);
            header("Location: change-password.php?success=Your password has been updated successfully");

        } else{
            header("Location: change-password.php?error=Incorrect password");
            exit();
        }
    }


} else {
    header("Location: change-password.php");
    exit();
    }

} else{
    header("Location: index.php");
    exit();
}