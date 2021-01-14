<?php
session_start();

if(isset($_SESSION['userID']) && isset($_SESSION['userName'])){

    include "db_conn.php";

    if (isset($_POST['ou']) && isset($_POST['nu']) 
        && isset($_POST['c_nu'])){
       
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        $ou = validate($_POST['ou']);
        $nu = validate($_POST['nu']);
        $c_nu = validate($_POST['c_nu']);

        if(empty($ou)){
            header("Location: change-username.php?error=Old Username is necessary");
            exit();
        } else if(empty($nu)){
            header("Location: change-username.php?error=New Username is necessary");
            exit();
        } else if($nu !== $c_nu){
            header("Location: change-username.php?error=Confirmation username does not match");
            exit();
        } else{
            $id = $_SESSION['userID'];

            $sql = "SELECT userName 
                    FROM person WHERE
                    userID=$id AND userName='$ou'";

                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) === 1){
                        $sql_2 = "UPDATE person
                                 SET userName='$nu'
                                 WHERE userID='$id'";
                        
                        $result_2 = mysqli_query($conn, $sql_2);
                        
                        header("Location: change-username.php?success=Username successfully updated");
                        exit();
                        

                    } else{
                        header("Location: change-username.php?error=Iccorrect Username");
                        exit();
                    }
        }

    } else{
        header("Location: change-username.php");
        exit();
    }


} else{
    header("Location: index.php");
    exit();
}