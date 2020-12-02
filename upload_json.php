<?php 

	$connect = mysqli_connect("localhost", "root", "", "web");


	/* ini_set("memory_limit", "800M"); */
	$user = $_POST ["usrid"];
	$filename = "location.json";
	$data = file_get_contents($filename);
	$array = json_decode($data,true);
	foreach($array['locations'] as $row){
		$lat = $row['latitudeE7'];
		$lon = $row['longitudeE7'];
		if (array_key_exists('activity', $row)){     //kapoia objects den exoun activity key

			foreach($row['activity'] as $row2){
				$date = date_create();
				date_timestamp_set($date, ((int) $row2['timestampMs'])/1000);
				$time = date_format($date, 'Y-m-d H:i:s');
				$sql_ins = "INSERT INTO `projdata` (`userID`, `longitudeE7`, `latitudeE7`, `timestampMS`, `likelyActivity`) VALUES ('".$user."', '".$row['longitudeE7']."', '".$row['latitudeE7']."', '".$time."', '".$row2['activity'][0]['type']."')";
				mysqli_query($connect, $sql_ins);
			}
		}
	}
?>