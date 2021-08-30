<?php
include("../../include/conFig.php");
$tid = $_GET['tid'];
	mysql_query("UPDATE `task` SET `delete` = '1'  WHERE `id` = '$tid'",$con) or die(mysql_error());
	mysql_query("UPDATE `taskreassign` SET `delete` = '1'  WHERE `taskid` = '$tid'",$con) or die(mysql_error());
	
?>
