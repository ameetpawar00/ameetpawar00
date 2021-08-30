<?php
include("../../include/conFig.php");
$tid = $_GET['tid'];
$getask = mysql_query("SELECT * FROM `task` WHERE `delete` = '0' AND `id` = '$tid' ",$con) or die(mysql_error());
$rowtask = mysql_fetch_array($getask);
if($rowtask['close'] == 0)
{
	echo "UPDATE `task` SET `close` = '1', `status` = '0' WHERE `id` = '$tid'";
	mysql_query("UPDATE `task` SET `close` = '1' , `status` = '0' WHERE `id` = '$tid'",$con) or die(mysql_error());
}
?>
