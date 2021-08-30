<?php
include("../include/conFig.php");
$value = $_GET['value'];
$atten = $_GET['atten'];
$dx = $_GET['dx'];
$table = $_GET['table'];
$selectedDate = $_GET['selectedDate'];
$attendance = $_GET['attendance'];
$dx = explode(",",$dx);
$atten = explode(",",$attendance);
foreach($dx as $key => $val)
{
	mysql_query("UPDATE `attendance` SET `attendance` = '$atten[$key]',`approved` = '$value' WHERE `id` = '$val' AND `date` = '$selectedDate'",$con) or die(mysql_error());
}


?>
