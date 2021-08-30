<?php
include("include/conFig.php");
$table = $_POST['table'];
$id = $_POST['id'];
//echo "UPDATE `$table` SET `delete` = '1' WHERE `id` = '$id'";
mysql_query("UPDATE `$table` SET `delete` = '1' WHERE `id` = '$id'",$con) or die(mysql_error());
?>