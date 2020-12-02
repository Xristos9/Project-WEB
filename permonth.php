<?php
	$link=mysqli_connect("localhost","root","Dimitra","web") or die(mysqli_error());
	mysqli_set_charset($link, "utf8");
	echo "<!DOCTYPE HTML>\n";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
		echo "<head>\n";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf8\">\n";
			echo "<meta http-equiv=\"content-language\" content=\"el\">";
		echo "</head>\n";
		echo "<body>\n";
			echo "<h1>Ανά Χρήστη</h1>\n";
			echo "<table border=\"1\">\n";
				echo "<tr align=\"center\">\n";
					echo "<td>A/A</td>\n";
					echo "<td>Όνομα Χρήστη</td>\n";
					echo "<td>Κατανομή</td>\n";
				echo "</tr>\n";
				$usersquery = "SELECT * FROM projdata";
				$usersresult = mysqli_query($link,$usersquery) or die(mysqli_error());
				$aa=0;
				for ($i=0; $i<mysqli_num_rows($usersresult); $i++) {
					$usersrow=mysqli_fetch_array($usersresult);
					$statistquery = "SELECT count(*) FROM statistika where AMOSs=".$usersrow[0]."";
					$statistresult = mysqli_query($link,$statistquery);
					if(!empty(mysqli_num_rows($statistresult))){
						$statrow=mysqli_fetch_array($statistresult);
						echo "<tr align=\"center\">\n";
						$aa++;
						echo "<td>".$aa."</td>\n";
						echo "<td>".$usersrow[0]."</td>\n";
						echo "<td>".$statrow[0]."</td>\n";
					}
					echo "</tr>\n";
				}
			echo "</table>\n";
		echo "</body>\n";
	echo "</html>\n";
?>