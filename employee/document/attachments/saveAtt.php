<?php
include("../include/conFig.php");
$path = $_GET['path'];
$reqid = $_GET['reqid'];
$getPath = mysql_query("SELECT `attachments` FROM `requirement` WHERE `id` = '$reqid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getPath);
if($row[0] != '')
{
$inspath = $row[0].$path;
}
else
{
$inspath = $path; 
}
if($path != '')
{
mysql_query("UPDATE `requirement` SET `attachments` = '$inspath' WHERE `id` = '$reqid'",$con) or die(mysql_error());
}
?>