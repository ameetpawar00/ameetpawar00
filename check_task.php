<?php
include("include/conFig.php");
	$getemptask = mysql_query("SELECT * FROM `task` WHERE `delete` = '0' AND `teamember` LIKE '%$hrmloggedid%' ",$con) or die(mysql_error());
			$rowemptask = mysql_fetch_array($getemptask);
			
			echo $taskno = mysql_num_rows($getemptask);
			
			?>
			