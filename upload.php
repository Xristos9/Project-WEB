<?php
    include "db_conn.php";
    session_start();
	$u=$_SESSION["userID"];
	$k = json_decode($_POST["kati"], true);
	
	$a = (array_shift($k));

	$sql = mysqli_query($conn,"INSERT INTO `ips` (`userID`,`IP`,`lan`,`lon`,`ISP`) VALUES ('$u','".$a['ip']."', '".$a['lat']."','".$a['lon']."','".$a['par']."');");
	
	$result = mysqli_query($conn,"SELECT MAX(`entryID`) FROM `ips`"); 
	while($row = mysqli_fetch_array($result))
	{
		$f =$row[0];
	}

	foreach($k as $single_data){
	$sql = mysqli_query($conn,"INSERT INTO `hardata` (`entryID`, `startedDateTime`, `serverIPAddress`,`timingsWait`,`method`,`url`,`status`,`statusText`,`RqContentType`,`RsContentType`,`RqCacheControl`,`RsCacheControl`,`RqExpires`,`RsExpires`,`pragma`,`host`,`lastModified`,`age`) VALUES ('$f', '".$single_data['startedDateTime']."', '".$single_data['serverIPAddress']."', '".$single_data['timingsWait']."', '".$single_data['method']."', '".$single_data['url']."', '".$single_data['status']."', '".$single_data['statusText']."', '".$single_data['RqContentType']."', '".$single_data['RsContentType']."', '".$single_data['RqCacheControl']."', '".$single_data['RsCacheControl']."', '".$single_data['RqExpires']."', '".$single_data['RsExpires']."', '".$single_data['pragma']."', '".$single_data['host']."', '".$single_data['lastModified']."', '".$single_data['age']."');");
	}

   
	
	// if ($conn->query($sql) === TRUE) {
	//     echo "  New record created successfully";
	//   } else {
	//     echo "Error: " . $sql . "<br>" . $conn->error;
	//   }

?>
