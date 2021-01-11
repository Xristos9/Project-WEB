<?php
$conn = mysqli_connect("localhost", "root", "","web");
    
if(!$conn){
    exit("Connection error!");
} else{
    echo "conn <br />";
}

$result = mysqli_query($conn,"SELECT serverIPAddress FROM hardata WHERE RsContentType like '%html%' OR RsContentType like '%javascript%' OR RsContentType like '%php%' ORDER BY `hardata`.`serverIPAddress` ASC");
$a= array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($a,$row['serverIPAddress']);
    }
}
// $a= json_encode($a);



?>

