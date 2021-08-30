<?php
include("../../include/conFig.php");
$tid = $_GET['tid'];
$getask = mysql_query("SELECT * FROM `task` WHERE `delete` = '0' AND `id` = '$tid' ",$con) or die(mysql_error());
$rowtask = mysql_fetch_array($getask);
if($rowtask['status'] == 0)
{
	mysql_query("UPDATE `task` SET `status` = '1' WHERE `id` = '$tid'",$con) or die(mysql_error());
}
if($rowtask['status'] == 1)
{
	mysql_query("UPDATE `task` SET `status` = '0' WHERE `id` = '$tid'",$con) or die(mysql_error());

}
?>
