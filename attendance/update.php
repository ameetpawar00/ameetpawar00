<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `attendance` SET `checkin`='$post[0]',`checkout`='$post[1]',`attendance`='$post[2]' WHERE `id` = '$id'",$con) or die(mysql_error());
?>