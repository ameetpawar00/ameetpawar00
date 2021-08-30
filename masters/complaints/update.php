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
mysql_query("UPDATE `complaints` SET `name`='$post[0]',`description`='$post[1]',`modifieddate` = '$datetime', `updatedby`  = '$loggeduserid' WHERE `id` = '$id'",$con);
?>
