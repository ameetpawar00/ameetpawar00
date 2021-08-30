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
mysql_query("UPDATE `education` SET `school`='$post[0]',`degree`='$post[1]',`fieldsofstudy`='$post[2]',`doc`='$post[3]',`interest`='$post[4]',`updatedate`='$datetime',`updatedby` = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
?>
