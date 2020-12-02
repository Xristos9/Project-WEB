<!DOCTYPE html>
<html>
<head>
<!-- <script type="text/javascript" src="myjss.js"></script> -->

<script type="text/javascript">

	function myWeb() {
/* 		var selectBox = document.getElementById("actname");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		alert(selectedValue); */
		
		var objConnection = new ActiveXObject("adodb.connection");
		var strConn = "driver={sql server};server=localhost;database=web;uid=root;password=Aris03Il";
//alert(strConn);
		objConnection.Open(strConn);
alert("2");
//		var rs = new ActiveXObject("ADODB.Recordset");
//alert(rs);
		var strQuery = "SELECT * FROM `projdata` WHERE likelyActivity = '"+getElementById.value("actname")+"'";

		alert(strQuery);

		rs.Open(strQuery,objConnection);
	}

</script>

</head>

$qqq = "Select count(*) from projdata where timestampMS=MONTH(CURRENT_DATE())";
$qqqresult = mysqli_query($connect, $qqq); // συνολικοί χρήστες αυτόν το μήνα
$qqqrow = $qqqresult;

$qqq1 = "Select count(*) from projdata where timestampMS=MONTH(CURRENT_DATE()) AND (acttype='' OR...";
$qqq1result = mysqli_query($connect, $qqq1); // συνολικοί οικολόγοι χρήστες αυτόν το μήνα
$qqq1row = $qqq1result;

$ypologismos = $qqq1row[0] * 100 / $qqqrow[0];


<?php
	$connect = mysqli_connect("localhost", "root", "Aris03Il", "web");
	

	echo "<body>\n";
	
	echo "<form>\n";
	echo "<select name = \"actname\" id = \"actname\" onchange=\"myWeb();\">\n";
	echo "<option value=\"\"></option>\n";
	$actquery = "SELECT acttype FROM activitytype";
	$actresult = mysqli_query($connect, $actquery);
    for ($i=0; $i<mysqli_num_rows($actresult); $i++) {
		$actrow=mysqli_fetch_array($actresult);
	
	  echo "<option value=\"".$actrow[0]."\">".$actrow[0]."</option>\n";
	}
	echo "</select>\n";
	  
	echo "</form>\n";

	echo "</body>\n";
	echo "</html>\n";
?>