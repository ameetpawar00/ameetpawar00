<?php
include("../include/conFig.php");
$dx = $_GET['dx'];
$table = $_GET['table'];
$value = $_GET['value'];

$dx = explode(",",$dx);
foreach($dx as $val)
{
	mysql_query("UPDATE `$table` SET `approved` = '$value' WHERE `id` = '$val'",$con) or die(mysql_error());
}
?>