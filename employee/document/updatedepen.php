<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `dependent` SET `name`='$post[0]',`relationshipid`='$post[1]',`dob`='$post[2]',`updatedate`= '$datetime',`updatedby` = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
?>
