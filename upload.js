<?php
	include "db_conn.php";

	session_start();
	$userID=$_SESSION["userID"];

    $result = mysqli_query($conn,"SELECT serverIPAddress FROM hardata INNER JOIN ips ON hardata.entryID = ips.entryID WHERE `ips`.`userID`=$userID AND (RsContentType like '%html%' OR RsContentType like '%javascript%' OR RsContentType like '%php%' OR RqContentType like '%html%' OR RqContentType like '%javascript%' OR RqContentType like '%php%') ORDER BY `hardata`.`serverIPAddress` ASC");
	$servers= array();
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			array_push($servers,$row['serverIPAddress']);
		}
	}
	// print_r($userID);
	
	$result2 = mysqli_query($conn,"SELECT Date FROM ips WHERE `userID`=$userID ORDER BY `ips`.`Date` ASC");

	$dates= array();
	if ($result2->num_rows > 0) {
		// output data of each row
		while($row = $result2->fetch_assoc()) {
			array_push($dates,$row['Date']);
		}
	}
	$_SESSION["uDate"]=end($dates);
	// print_r($_SESSION["uDate"]);


	
	$result3 = mysqli_query($conn,"SELECT entryID FROM `ips` WHERE `userID`=$userID");
	$entries= array();
	if ($result3->num_rows > 0) {
		// output data of each row
		while($row = $result3->fetch_assoc()) {
			array_push($entries,$row['entryID']);
		}
	}
	$_SESSION["nOfEntries"]=(count($entries));

	
?>
