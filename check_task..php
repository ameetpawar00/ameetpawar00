<?php
include("include/conFig.php");
	$getemptask = mysql_query("SELECT `read` FROM `task` WHERE `delete` = '0' AND `id` = '$hrmloggedid' ",$con) or die(mysql_error());
			$rowemptask = mysql_fetch_array($getemptask);
			
			echo $taskno = mysql_num_rows($getemptask);
			
			?>