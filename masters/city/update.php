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
mysql_query("UPDATE `city` SET `name`='$post[2]',`state`='$post[1]',`description`='$post[3]',`modifieddate` = '$datetime', `updatedby`  = '$loggeduserid' WHERE `id` = '$id'",$con);
?>
<div style="background:#CCFF99;color:#222;font-weight:bold;padding:2px;">
City Successfully Updated</div>
