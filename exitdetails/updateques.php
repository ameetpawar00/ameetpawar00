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
mysql_query("UPDATE `seperationquestion` SET `answer`='$post[0]', `updatedate`='$datetime',`updatedby` = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
?>
