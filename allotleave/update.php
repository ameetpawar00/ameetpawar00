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
echo "UPDATE `allotleave` SET `designation`='$post[0]',`leave`='$post[1]', `updatedate`= '$datetime',`updatedby` = '$hrmloggedid' WHERE `id` = '$id'";
mysql_query("UPDATE `allotleave` SET `designation`='$post[0]',`leave`='$post[1]', `modifieddate`= '$datetime',`updatedby` = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
?>
